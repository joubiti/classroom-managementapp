import sys
from student import curriculum, classe

class Menu:
    def __init__(self):
        self.choices={
            "1": self.create_student,
            "2": self.create_teacher,
            "3": self.affect_grade,
            "4": self.print_info,
            "5": self.student_list,
            "6": self.teacher_list,
            "7": self.print_grades,
            "8": self.print_highest_grades,
            "9": self.print_average_grade,
            "10": self.delete,
            "11": self.delete_prof,
            "12": self.quit
        }

    def display(self):
        print("""
                                    Classroom management CLI application

                                    1. Create a student
                                    2. Create a professor
                                    3. Affect grade to a student
                                    4. Print general information about the classroom
                                    5. Print list of students
                                    6. Print list of teachers
                                    7. Print grades for a given student
                                    8. Print highest grades for a given course
                                    9. Print average grade for a given course
                                    10. Delete a student
                                    11. Delete a professor
                                    12. Exit
        """)
    
    def run(self):
        while True:
            self.display()
            user_choice = input("Please choose an option: \n")
            action= self.choices.get(user_choice)
            if action:
                action()
            else:
                print("Wrong option!")

    def create_student(self):
        filter= input("Please type in first name and last name in the following format, example: Achraf,Joubiti \n")
        param= filter.split(',')
        classe.add_student(param[0],param[1])
        print(f"Student {param[0]} {param[1]} has succesfully been created!")
    
    def create_teacher(self):
        filter= input("Please type in first name and last name in the following format, example: Teacher,Test \n")
        param= filter.split(',')
        param1= input("Which courses will this professor be in charge of? Please follow the following format, example: Algebra,Web Development,Algorithms \n")
        classe.add_professor(param[0],param[1],param1.split(','))
        print(f"Professor {param[0]} {param[1]}, has succesfully been created!")

    def affect_grade(self):
        print("Here is a list of students with their unique IDs: \n")
        for student in classe.students:
            print(f"{student.id} . {student.firstname} {student.lastname} \n")
        param= input("Please type the ID of the student: \n")
        print("Here is a list of courses with their uniques IDs: \n")
        for course in curriculum.coursework:
            print(f"{course.id} . {course.course_name} taken in charge by the professor {course.get_teacher().firstname} {course.get_teacher().lastname}")
        param1= input("Please type the ID of the corresponding course: \n")
        param2= input("Type the desired grade /20: \n")
        classe.update_grade(int(param),int(param1),int(param2))
        print("Grade succesfully updated!")

    def print_info(self):
        classe.display_info()

    def student_list(self):
        print("The students currently in this classroom are: \n")
        classe.display_students()

    def teacher_list(self):
        print("The professors currently in this classroom, along with the courses they're in charge of, are: \n")
        classe.display_professors()

    def print_grades(self):
        print("Here is a list of students with their unique IDs: \n")
        for student in classe.students:
            print(f"{student.id} . {student.firstname} {student.lastname} \n")
        param= input("Please type the ID of the student: \n")
        print("The grades for this student are:")
        classe.display_grades(int(param))

    def print_highest_grades(self):
        print("Here is a list of courses with their uniques IDs: \n")
        for course in curriculum.coursework:
            print(f"{course.id} . {course.course_name} taken in charge by the professor {course.get_teacher().firstname} {course.get_teacher().lastname}")
        param1= input("Please type the ID of the corresponding course: \n")
        classe.display_highestgrade(int(param1))

    def print_average_grade(self):
        print("Here is a list of courses with their uniques IDs: \n")
        for course in curriculum.coursework:
            print(f"{course.id} . {course.course_name} taken in charge by the professor {course.get_teacher().firstname} {course.get_teacher().lastname}")
        param1= input("Please type the ID of the corresponding course: \n")
        classe.display_averagegrade(int(param1))

    def quit(self):
        sys.exit()

    def delete(self):
        filter= input("Please type in first name and last name in the following format, example: Achraf,Joubiti \n")
        param= filter.split(',')
        classe.remove_student(param[0],param[1])
        print(f"Student {param[0]} {param[1]}, has succesfully been deleted!")

    def delete_prof(self):
        filter= input("Please type in first name and last name in the following format, example: Teacher,Test \n")
        param= filter.split(',')
        classe.remove_professor(param[0],param[1])
        print(f"Professor {param[0]} {param[1]}, has succesfully been deleted!")
                
if __name__ == "__main__":
    Menu().run()