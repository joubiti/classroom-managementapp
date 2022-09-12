from student import Professor, classe, curriculum, Grade, Student
import unittest

class TestApp(unittest.TestCase):
    @classmethod
    def setUpClass(self):
        self.professor= Professor("Test","Professor",["Algèbre","Analyse"])
    
    def test_1(self):
        self.assertEqual([self.professor.firstname, self.professor.lastname, self.professor.id], ["Test","Professor",1], "Initial test FAILED")
    
    def test_2(self):
        self.assertEqual(self.professor.get_courses(),["Algèbre","Analyse"], "Courses not matching")

    def test_3(self):
        self.professor.add_course(["Programmation"])
        self.assertEqual(self.professor.get_courses(),["Algèbre","Analyse","Programmation"], "ADD_COURSE method failing")

class TestClassroom(unittest.TestCase):
    def test_1(self):
        classe.add_professor("Test","Professor",["Algèbre","Analyse"])
        self.assertEqual(classe.professors[0].firstname, "Test")
    
    def test_2(self):
        classe.remove_professor("Test","Professor")
        self.assertEqual(classe.professors, [])
    
    def test_3(self):
        classe.add_student("Test","Student")
        self.assertEqual(classe.students[0].firstname, "Test")
    
    def test_4(self):
        classe.remove_student("Test","Student")
        self.assertEqual(classe.students, [])
    
    
unittest.main()