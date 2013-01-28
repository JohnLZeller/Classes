all: calc testda

calc: dynamicArray.o calc.o
	gcc -g -Wall -std=c99 -o calc dynamicArray.o calc.o -lm

testda: dynamicArray.o testDynArray.o
	gcc -g -Wall -std=c99 -o testda dynamicArray.o testDynArray.o

calc.o: calc.c dynamicArray.h
	gcc -g -Wall -std=c99 -c calc.c

testDynArray.o: testDynArray.c dynamicArray.h
	gcc -g -Wall -std=c99 -c testDynArray.c

dynamicArray.o: dynamicArray.c dynamicArray.h 
	gcc -g -Wall -std=c99 -c dynamicArray.c	
		
clean:
	rm dynamicArray.o
	rm calc.o
	rm testDynArray.o
	rm calc
	rm testda
