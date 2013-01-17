/* CS261- Assignment 1 - Q. 0*/
/* Name: John Zeller
 * Date: January 16, 2013
 * Solution description: In main(), integer x is declared and set to 0, the address of x is printed,
 *                       and then the address of x is passed into the function fooA(int* iptr). In fooA(int* iptr), the
 *                       value pointed to by iptr is printed, the address pointed to by iptr is printed, and the addres
 *                       of iptr is printed before concluding the function. Finally, in main(), the value of x is printed
 *                       and 0 is returned.
 * Development environment: Code::Blocks IDE 10.05
 */

#include <stdio.h>
#include <stdlib.h>

void fooA(int* iptr){
     /*Print the value pointed to by iptr*/
     printf("Value pointed to by iptr: %d\n", *iptr);

     /*Print the address pointed to by iptr*/
     printf("Address pointed to by iptr: %p\n", iptr);

     /*Print the address of iptr itself*/
     printf("Address of iptr: %p\n", &iptr);
}

int main(){

    /*declare an integer x*/
    int x = 0;

    /*print the address of x*/
    printf("Address of x: %p\n", &x);

    /*Call fooA() with the address of x*/
    fooA(&x);

    /*print the value of x*/
    printf("Value of X: %d\n", x);

    return 0;
}
