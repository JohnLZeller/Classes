default: prog

dynamicArray.o: dynamicArray.c dynamicArray.h
	gcc -Wall -std=c99 -c dynamicArray.c

prog: dynamicArray.o
	gcc -Wall -std=c99 -o prog dynamicArray.o dynamicArrayMain.c

clean:
	rm dynamicArray.o

cleanall: clean
	rm prog
