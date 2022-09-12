import math
from urllib.request import Request, urlopen
from bs4 import BeautifulSoup as soup
import sys


student_id=0
professor_id=0
course_id=0

class Professor:
	'Represents a professor for one or more courses, if course name does not exist, course is automatically created'
	def __init__(self, firstname, lastname, courses=[]):
		self.firstname= firstname
		self.lastname= lastname
		global professor_id
		professor_id+=1
		self.id=professor_id
		global curriculum
		self.add_course(courses)

	def add_course(self, list_of_courses):
		'Affect a list of courses to a professor'
		for course in list_of_courses:
			for entry in curriculum.coursework:
				if course == entry.course_name:
					entry.professor_id= self.id
				else:
					pass
			curriculum.add_course(course, self.id)

	def get_courses(self):
		'Returns a list of courses taken in charge by professor'
		return [entry.course_name for entry in curriculum.coursework if entry.professor_id== self.id]


class Classroom:
	'Represents a classroom of students with professors'
	def __init__(self):
		'Initialize list of students and professors'
		self.students=[]
		self.professors=[]
		global curriculum
		self.exam_spreadsheet= self.get_exam_spreadsheet()

	def display_info(self):
		'Prints general info about classroom'
		print(f"""
			Number of students in the classroom: {len(self.students)}
			Number of professors in the classroom: {len(self.professors)}
			Number of courses: {len(curriculum.coursework)}
			Exam spreadsheet: {self.exam_spreadsheet}
			""")
		for course in curriculum.coursework:
			print(f"The course {course.course_name} is being taken charge by the professor {course.get_teacher().firstname.capitalize()} {course.get_teacher().lastname.capitalize()}")

	def display_grades(self, student_id):
		'Display grades of given student id'
		for student in self.students:
			if student.id == student_id:
				# print(student.show_grades())
				for key, value in student.show_grades().items():
					for course in curriculum.coursework:
						if key == course.id:
							print(f'{course.course_name} :> {value}')
	
	def display_highestgrade(self, course_id):
		'Prints student with the highest grade for given course id'
		max_value= None
		for student in self.students:
			for key, value in student.show_grades().items():
				if key == course_id:
					if max_value is None or value > max_value:
						max_value= value
						id_highestgrade= student.id
		
		for course in curriculum.coursework:
			if course.id == course_id:
				for student in self.students:
					if student.id == id_highestgrade:
						print(f"The highest grade for {course.course_name} is the student {student.firstname.capitalize()} {student.lastname.capitalize()} with a grade of {max_value}")

	def display_lowestgrade(self, course_id):
		'Prints student with the lowest grade for given course id'
		min_value= None
		for student in self.students:
			for key, value in student.show_grades().items():
				if key == course_id:
					if min_value is None or value < min_value:
						min_value= value
						id_highestgrade= student.id
		
		for course in curriculum.coursework:
			if course.id == course_id:
				for student in self.students:
					if student.id == id_highestgrade:
						print(f"The lowest grade for {course.course_name} is the student {student.firstname.capitalize()} {student.lastname.capitalize()} with a grade of {min_value}")

	def display_averagegrade(self, course_id):
		'Prints average grade in a classroom for a given course id'
		placeholder_list=[]
		for course in curriculum.coursework:
			if course.id == course_id:
				for student in self.students:
					for key, value in student.show_grades().items():
						if key == course.id:
							placeholder_list.append(value)
		
		for course in curriculum.coursework:
			if course.id == course_id:
				print(f"The average grade for {course.course_name} is {sum(placeholder_list)/len(placeholder_list)}")

	def get_exam_spreadsheet(self):
		'Scrapes the ENSAF website to fetch the exam spreadsheet'
		links=[]
		url = "https://ensaf.ac.ma/?controller=pages&action=emplois"
		req = Request(url , headers={'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246'})
		py_url=urlopen(req)
		rawhtml=py_url.read()
		scrape=soup(rawhtml,'lxml')
		info=scrape.find('div',class_='table-responsive')
		spreadsheets=info.tbody
		auto=spreadsheets.tr
		exam_fixture=auto.select_one("tr td:nth-of-type(2)")
		for link in exam_fixture.find_all('a'):
			autourl=link.get('href')
		links.append(autourl)
		return links[-1]

	def update_grade(self, student_id, course_id, grade):
		'Updates grade for given course id and student id'
		for student in self.students:
			if student.id== student_id:
				student.grade.update_grade(course_id, grade)

	def display_students(self):
		'Displays list of students'
		for student in self.students:
			print(f"({student.firstname}, {student.lastname})")

	def display_professors(self):
		'Displays list of professors'
		for professor in self.professors:
			print(f"({professor.firstname}, {professor.lastname}, {professor.get_courses()})")

	def add_professor(self, firstname, lastname, courses=[]):
		'Add professor to classroom given first and last name'
		self.professors.append(Professor(firstname, lastname, courses))

	def remove_professor(self, firstname, lastname):
		'Remove professor from classroom'
		for professor in self.professors:
			if professor.firstname== firstname and professor.lastname== lastname:
				self.professors.remove(professor)
		curriculum.coursework= [entry for entry in curriculum.coursework if entry.get_teacher() is not None]

	def add_student(self, firstname, lastname):
		'Add student to classroom given first and last name'
		self.students.append(Student(firstname, lastname))

	def remove_student(self, firstname, lastname):
		'Remove student from classroom'
		for student in self.students:
			if student.firstname== firstname and student.lastname== lastname:
				self.students.remove(student)

class Student:
	'Represents a student in a classroom'
	def __init__(self, firstname, lastname):
		'Initializes a student given first name and last name with unique id'
		self.firstname= firstname
		self.lastname=  lastname
		global student_id
		student_id+=1
		self.id= student_id
		self.grade=Grade(self.id)

	def show_grades(self):
		'Returns dictionary of grades for each of the courses'
		return self.grade.grades


class Grade:
	'Represents a grade object associated to each student'
	def __init__(self, student_id):
		'Initialize grades for specified student'
		self.student_id= student_id
		self.grades={}
	
	def update_grade(self, course_id, grade):
		'Update grades given the mark and course id'
		self.grades.update({course_id: grade})


class Coursework:
	'Represents coursework object which contains list of courses'
	def __init__(self):
		'Initialize coursework'
		self.coursework=[]

	def add_course(self, name, professor_id=None):
		'Append course with given name to the coursework'
		self.coursework.append(Course(name, professor_id))

	def remove_course(self, course_id):
		'Remove course from coursework with given id'
		for course in self.coursework:
			if course.id == course_id:
				self.coursework.remove(course)


class Course:
	'Represents a course object in coursework'
	def __init__(self, course_name, professor_id=None):
		'Initialize course given its name'
		self.course_name=course_name
		self.professor_id=professor_id
		global course_id
		course_id+=1
		self.id=course_id

	def get_teacher(self):
		'Returns professor in charge of the course'
		global classe
		for professor in classe.professors:
			if self.professor_id == professor.id:
				return professor

curriculum= Coursework()
classe= Classroom()