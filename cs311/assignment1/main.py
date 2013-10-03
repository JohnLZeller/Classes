import os
import sys
import getopt


def main():
    choice, term, course = parseArgs()

    if choice is 1:
        makeDirectories(term, course)
    elif choice is 2:
        greatestProduct()
    elif choice is 3:
        names()
    elif choice is 4:
        nthTerm()


def parseArgs():
    try:
        optlist, args = getopt.getopt(
            sys.argv[1:], "hp:t:c:", ["help", "program", "term", "course"])
    except getopt.GetoptError as e:
        print str(e)
        usage()
        sys.exit(2)

    choice = None
    term = None
    course = None
    require = False
    for opt, arg in optlist:
        if opt in ("-h", "--help"):
            usage()
            sys.exit()
        elif opt in ("-p", "--program"):
            choice = int(arg)
            if choice is 1:
                require = True
        elif opt in ("-t", "--term"):
            term = arg
        elif opt in ("-c", "--course"):
            course = arg
        else:
            assert False, "Option not supported"

    if len(sys.argv) < 2 or choice is None:
        print "Missing arguments and/or options"
        usage()
        sys.exit(2)
    elif require:
        if term is None or course is None:
            print "Term and Course are required options when choosing program 1"
            usage()
            sys.exit(2)

    return choice, term, course


def usage():
    print """
        -h, --help      Prints usage info
        -p, --program   1-4:    1 - Create Directories
                                2 - Find Greatest Product
                                3 - Sort Names
                                4 - Find Triangle Words

        Required if program 1 is selected:
        -t, --term      Choose Fall, Winter, Spring or Summer
        -c, --course    Choose course number like CS311"""


def makeDirectories(term, course):
    directories = ["assignments", "examples", "exams",
                   "lecture_notes", "submissions"]
    website_path = "/usr/local/classes/eecs/" + \
        term + "/" + course + "/public_html"
    handin_path = "/usr/local/classes/eecs/" + \
        term + "/" + course + "/handin"

    for directory in directories:
        try:
            os.makedirs(directory)
        except OSError as e:
            if e.strerror == "File exists":
                print "The directory '" + directory + "' already exists"
            else:
                print "OSError({0}): {1}".format(e.errno, e.strerror)

    try:
        os.symlink(website_path, "website")
    except OSError as e:
        if e.strerror == "File exists":
            print "The directory 'website' already exists"
        else:
            print "OSError({0}): {1}".format(e.errno, e.strerror)
    try:
        os.symlink(handin_path, "handin")
    except OSError as e:
        if e.strerror == "File exists":
            print "The directory 'handin' already exists"
        else:
            print "OSError({0}): {1}".format(e.errno, e.strerror)


def greatestProduct():
    data = ""
    f = open('numbers.txt', 'r')
    for line in f:
        data += line.rstrip("\n")
    maxList = []
    
    for x in range(4, len(data)):
        product = int(data[x - 4])
        for a in range(x - 3, x + 1):
            product *= int(data[a])
        maxList.append(product)
    maximum = max(num for num in maxList)
    print maximum


def names():
    with open('names.txt') as f:
        namesList = sorted([word.split('"')[1] for word in f.read().split(',')])
    sumList = []
    for index, name in enumerate(namesList):
        sumList.append(sum([ord(char) - 96 for char in name.lower()]) * (index + 1))
    print sum(sumList)


def nthTerm():
    with open('words.txt') as f:
        wordsList = sorted([word.split('"')[1] for word in f.read().split(',')])
    sumList = []
    for word in wordsList:
        sumList.append(sum([ord(char) - 96 for char in word.lower()]))
    triangleList = []
    for index, s in enumerate(sumList):
        for x in range(s+1):
            if s is int(0.5*x*(x+1)):\
                triangleList.append(wordsList[index])
    print len(triangleList)

if __name__ == '__main__':
    main()
