/* CS261- Assignment 1 - Q.2*/
/* Name: John Zeller
 * Date: January 16, 2013
 * Solution description: Create and calls foo() which doubles the first integar, halves the second
 *                       integer and then sums the first and second to input as the third integer.
 *                       Values for all 3 integers are printed before and after using foo().
 * Development environment: Code::Blocks IDE 10.05
 */

#include <stdio.h>
#include <stdlib.h>

int foo(int* a, int* b, int c){
    /*Set a to double its original value*/
    *a = *a * 2;

    /*Set b to half its original value*/
    *b = *b / 2;

    /*Assign a+b to c*/
    c = *a + *b;

    /*Return c*/
    return c;
}

int main(){
    /*Declare three integers x,y and z and initialize them to 5, 6, 7 respectively*/
    int x = 5;
    int y = 6;
    int z = 7;

    /*Print the values of x, y and z*/
    printf("Value of x: %d\n", x);
    printf("Value of y: %d\n", y);
    printf("Value of z: %d\n", z);

    /*Call foo() appropriately, passing x,y,z as parameters*/
    int val = foo(&x, &y, z);

    /*Print the value returned by foo*/
    printf("Value returned by foo: %d\n", val);

    /*Print the values of x, y and z again*/
    printf("Value of x: %d\n", x);
    printf("Value of y: %d\n", y);
    printf("Value of z: %d\n", z);

    /*Is the return value different than the value of z?  Why?*/
    /* The return value is different than the value of z because z was passed-by-value
     * into foo, instead of passed-by-reference like x and y. Effectively, what happens
     * in this case is that the VALUE of 7 is used and then modified by foo, while the
     * value of z remains unchanged, because foo was never given a way to access it
     */
    return 0;
}


