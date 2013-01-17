/* CS261- Assignment 1 - Q.4*/
/* Name: John Zeller
 * Date: January 16, 2013
 * Solution description: Create an array of struct students, assign them all randomly generated IDs and Scores,
 *                       then sort them from smallest to largest scores, and prints them both before and after
 *                       sorting.
 * Development environment: Code::Blocks IDE 10.05
 */

#include <stdio.h>
#include <stdlib.h>
#include <time.h>

struct student{
	int id;
	int score;
};

void sort(struct student* students, int n){
     /*Sort the n students based on their score*/
     /* Remember, each student must be matched with their original score after sorting */
     int currID, currScore;
     for(int i = 0; i < n; i++){
        currID = (students + i)->score;
        currScore = (students + i)->score;
        /* Now loop to find the next lowest, starting at current index number */
        for(int k = (i + 1); k < n; k++){   // Check to see if a number is lower than curr
            if((students + k)->score < currScore){                      //If there is a score lower than curr, then swap them in the array
                //Replace the current index ID and score with the ID and score at index k
                (students + i)->id = (students + k)->id;
                (students + i)->score = (students + k)->score;
                //Replace the ID and score at index k with currID and currScore
                (students + k)->id = currID;
                (students + k)->score = currScore;
                //Now update currID and currScore to represent the new ID and score at index i
                currID = (students + i)->id;
                currScore = (students + i)->score;
            }
        }
     }
}

int main(){
    /*Declare an integer n and assign it a value.*/
    int n = 20;

    /*Allocate memory for n students using malloc.*/
     struct student *Students = (struct student*) malloc(sizeof(struct student)*n);

    /*Generate random IDs and scores for the n students, using rand().*/
    /* Seed srand() */
    srand( time(NULL) );
    /* Generate random IDs and scores */
    for(int i = 0; i < n; i++){
        (Students + i)->id = rand() % 20 + 1; //Randomly generate an ID number betwen 1 and 20
        (Students + i)->score = rand() % 101; // Randomly generate a score between 0 and 100
    }

    /*Print the contents of the array of n students.*/
    for(int i = 0; i < n; i++){
        printf("%d %d\n", (Students + i)->id, (Students + i)->score);
    }
    printf("\n");

    /*Pass this array along with n to the sort() function*/
    sort(Students, n);

    /*Print the contents of the array of n students.*/
    for(int i = 0; i < n; i++){
        printf("%d %d\n", (Students + i)->id, (Students + i)->score);
    }

    return 0;
}
