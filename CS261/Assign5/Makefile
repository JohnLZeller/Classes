all: prog1 prog2

prog1: dynamicArray.o main.o toDoList.o
	gcc -g -Wall -std=c99 -o prog1 dynamicArray.o toDoList.o main.o
	
prog2: dynamicArray.o main2.o toDoList.o
	gcc -g -Wall -std=c99 -o prog2 dynamicArray.o toDoList.o main2.o
	
main.o: main.c dynamicArray.h type.h toDoList.h
	gcc -g -Wall -std=c99 -c main.c
	
main2.o: main2.c dynamicArray.h type.h toDoList.h
	gcc -g -Wall -std=c99 -c main2.c
	
dynamicArray.o: dynamicArray.c dynamicArray.h
	gcc -g -Wall -std=c99 -c dynamicArray.c
	
toDoList.o: toDoList.c toDoList.h
	gcc -g -Wall -std=c99 -c toDoList.c

clean:	
	rm dynamicArray.o
	rm toDoList.o
	rm main.o
	rm main2.o
	rm prog1
	rm prog2
