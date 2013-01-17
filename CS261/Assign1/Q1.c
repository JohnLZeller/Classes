/* CS261- Assignment 1 - Q.1*/
/* Name: John Zeller
 * Date: January 16, 2013
 * Solution description: Creates/allocates memory for an array of 10 struct students, randomly generates them all IDs and Scores,
 *                       calculates/prints min, max and average scores for all students and then deallocates the memory reserved
 *                       for the array of 10 struct students
 * Development environment: Code::Blocks IDE 10.05
 */

#include <stdio.h>
#include <stdlib.h>
#include <math.h>
#include <time.h>   //Used to seed the rand function

struct student{
	int id;
	int score;
};

struct student* allocate(){
     /*Allocate memory for ten students*/
     //Allocate 10 times the memory it takes to store 1 struct student... allowing the storage of 10 struct students. Also, cast a pointer to struct student
     struct student *Students = (struct student*) malloc(sizeof(struct student)*10);

     /*return the pointer*/
     return Students;
}

void generate(struct student* students){
     /*Generate random ID and scores for 10 students, ID being between 1 and 20, scores between 0 and 100*/

    /* Seed rand() */
    srand( time(NULL) );

    /* Generate random number while looping through students*/
    for(int i = 0; i < 10; i++){
        (students + i)->id = rand() % 20 + 1; //Randomly generate an ID number betwen 1 and 20
        (students + i)->score = rand() % 101; // Randomly generate a score between 0 and 100
    }
}

void output(struct student* students){
     /*Output information about the ten students in the format:
              ID1 Score1
              ID2 score2
              ID3 score3
              ...
              ID10 score10*/

    for(int i = 0; i < 10; i++){
        printf("%d %d\n", (students + i)->id, (students + i)->score);
    }
}

void summary(struct student* students){
     /*Compute and print the minimum, maximum and average scores of the ten students*/
    int min = 100;  //Set to highest possible minimum
    int max = 0;    //Set to lowest possible maximum
    int total = 0;
    float ave = 0.00;

    for(int i = 0; i < 10; i++){
        if(min > (students + i)->score){    //Loop through recording the min score
            min = (students + i)->score;
        }
        if(max < (students + i)->score){    //Loop through recording the max score
            max = (students + i)->score;
        }
        total += (students + i)->score;     //Calculate the total score
    }

    ave = total / 10.00;                       //Divide the total score by 10 to find the average score

    /* Print the max, min and averages */
    printf("Maximum Score: %d\n", max);
    printf("Minimum Score: %d\n", min);
    printf("Average Score: %.2f\n", ave);   //Only print float up to first 2 decimal places
}

void deallocate(struct student* stud){
     /*Deallocate memory from stud*/
     if(stud != NULL){
         free(stud);
         stud = 0;
     }
}

int main(){
    struct student* stud = NULL;

    /*call allocate*/
    stud = allocate(stud);

    /*call generate*/
    generate(stud);

    /*call output*/
    output(stud);

    /*call summary*/
    summary(stud);

    /*call deallocate*/
    deallocate(stud);

    return 0;
}
