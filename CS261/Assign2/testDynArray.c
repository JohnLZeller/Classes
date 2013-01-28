/* testDynArray.c
 * This file is used for testing the dynamicArray.c file. 
 * This test suite is by no means complete or thorough.
 * More testing is needed on your own.
 */
#include <stdio.h>
#include <stdlib.h>
#include "dynamicArray.h"


void assertTrue(int predicate, char *message) 
{
	printf("%s: ", message);
	if (predicate)
		printf("PASSED\n");
	else
		printf("FAILED\n");
}


// this main function contains some
int main(int argc, char* argv[]){

	DynArr *dyn;
	dyn = createDynArr(2);
	
	printf("\n\nTesting addDynArr...\n");
	addDynArr(dyn, 3);
	addDynArr(dyn, 4);
	addDynArr(dyn, 10);
	addDynArr(dyn, 5);
	addDynArr(dyn, 6);
	
	printf("The array's content: [3,4,10,5,6]\n");
	assertTrue(EQ(getDynArr(dyn, 0), 3), "Test 1st element == 3");
	assertTrue(EQ(getDynArr(dyn, 1), 4), "Test 2nd element == 4");
	assertTrue(EQ(getDynArr(dyn, 2), 10), "Test 3rd element == 10");
	assertTrue(EQ(getDynArr(dyn, 3), 5), "Test 4th element == 5");
	assertTrue(EQ(getDynArr(dyn, 4), 6), "Test 5th element == 6");
	assertTrue(sizeDynArr(dyn) == 5, "Test size = 5");
	
	printf("\n\nTesting putDynArr...\nCalling putDynArr(dyn, 2, 7)\n");
	putDynArr(dyn, 2, 7); 
	printf("The array's content: [3,4,7,5,6]\n");
	assertTrue(EQ(getDynArr(dyn, 2), 7), "Test 3rd element == 7");
	assertTrue(sizeDynArr(dyn) == 5, "Test size = 5");
	
	printf("\n\nTesting swapDynArr...\nCalling swapDynArr(dyn, 2, 4)\n");
	swapDynArr(dyn, 2, 4);
	printf("The array's content: [3,4,6,5,7]\n");
	assertTrue(EQ(getDynArr(dyn, 2), 6), "Test 3rd element == 6");
	assertTrue(EQ(getDynArr(dyn, 4), 7), "Test 5th element == 7");
	
	printf("\n\nTesting removeAtDynArr...\nCalling removeAtDynArr(dyn, 1)\n");
	removeAtDynArr(dyn, 1);
	printf("The array's content: [3,6,5,7]\n");
	assertTrue(EQ(getDynArr(dyn, 0), 3), "Test 1st element == 3");
	assertTrue(EQ(getDynArr(dyn, 3), 7), "Test 4th element == 7");
	assertTrue(sizeDynArr(dyn) == 4, "Test size = 4");
	
	printf("\n\nTesting stack interface...\n");
	printf("The stack's content: [3,6,5,7] <- top\n");
	assertTrue(!isEmptyDynArr(dyn), "Testing isEmptyDynArr");
	assertTrue(EQ(topDynArr(dyn), 7), "Test topDynArr == 7");
	
	popDynArr(dyn);
	printf("Poping...\nThe stack's content: [3,6,5] <- top\n");
	assertTrue(EQ(topDynArr(dyn), 5), "Test topDynArr == 5");
	
	pushDynArr(dyn, 9);
	printf("Pushing 9...\nThe stack's content: [3,6,5,9] <- top\n");
	assertTrue(EQ(topDynArr(dyn), 9), "Test topDynArr == 9");
	
	printf("\n\nTesting bag interface...\n");
	printf("The bag's content: [3,6,5,9]\n");
	assertTrue(containsDynArr(dyn, 3), "Test containing 3");
	assertTrue(containsDynArr(dyn, 6), "Test containing 6");
	assertTrue(containsDynArr(dyn, 5), "Test containing 5");
	assertTrue(containsDynArr(dyn, 9), "Test containing 9");
	assertTrue(!containsDynArr(dyn, 7), "Test not containing 7");
	
	removeDynArr(dyn, 3);
	printf("Removing 3...\nThe stack's content: [6,5,9]\n");
	assertTrue(!containsDynArr(dyn, 3), "Test not containing 3");
	
	return 0;
}