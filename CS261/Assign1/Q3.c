/* CS261- Assignment 1 - Q.3*/
/* Name: John Zeller
 * Date: January 16, 2013
 * Solution description: Creates an array of integers, fills them with randomly generated values, sorts them from
 *                       smallest to largest, and prints the array before and after sorting.
 * Development environment: Code::Blocks IDE 10.05
 */

#include <stdio.h>
#include <stdlib.h>
#include <time.h>

void sort(int* number, int n){
     /*Sort the given array number , of length n*/
     int curr;
     for(int i = 0; i < n; i++){
        curr = *(number + i);
        /* Now loop to find the next lowest, starting at current index number */
        for(int k = (i + 1); k < n; k++){   // Check to see if a number is lower than curr
            if(*(number + k) < curr){           //If there is a number lower than curr, then swap them in the array
                *(number + i) = *(number + k);  //Replace the current index number with the number at index k
                *(number + k) = curr;           //Replace the number at index k with curr
                curr = *(number + i);           //Now update curr to represent the new number at index i
            }
        }
     }
}

int main(){
    /*Declare an integer n and assign it a value of 20.*/
    int n = 20;

    /*Allocate memory for an array of n integers using malloc.*/
    int *pArray = (int *)malloc(sizeof(int)*n);

    /*Fill this array with random numbers, using rand().*/
    /* Seed srand */
    srand( time(NULL) );

    /* Generate random numbers */
    for(int i = 0; i < n; i++){
        *(pArray + i) = rand() % 100;
    }

    /*Print the contents of the array.*/
    for(int i = 0; i < n; i++){
        printf("%d, ", *(pArray + i));
    }
    printf("\n");

    /*Pass this array along with n to the sort() function of part a.*/
    sort(pArray, n);

    /*Print the contents of the array.*/
    for(int i = 0; i < n; i++){
        printf("%d, ", *(pArray + i));
    }
    printf("\n");

    return 0;
}
