/* sieve.c: Identifies all prime numbers up to a given number n
 * Author: John Zeller
 * Date Created: 10/12/2013
 * Last Date Modified: 10/16/2013
 */

#include <stdio.h>
#include <stdlib.h>
#include <math.h>

struct master_array *init_array(int n);
void mark_primes(struct master_array *a);
void print_arr(struct master_array *a);
void free_arr(struct master_array *a);

struct master_array
{
	int *data;	// Array of numbers to check
	int length;
	int primes;	// Total number of primes
};

int main(int argc, char *argv[])
{
    if(argc != 2){
        printf("Invalid input! You must include an integer greater than 0\n");
        return 1;
    }
    int n = atoi(argv[1]);
    if(n <= 0){
        printf("Invalid input! You must include an integer greater than 0\n");
        return 1;
    }
	struct master_array *a = init_array(n);
	mark_primes(a);
	print_arr(a);
    free_arr(a);
	return 0;
}

struct master_array *init_array(int n)
{
	struct master_array *a = malloc(sizeof(struct master_array));
	a->data = malloc(sizeof(int) * n);
	a->length = n;
	a->primes = 0;

	int i;
	for(i = 0; i < a->length; i++){
		a->data[i] = 0;
	}

	return a;
}

void mark_primes(struct master_array *a){
	int k;
	int j;
	a->data[0] = 1; // Mark the number 1 as special (it is neither prime nor composite).

	for(k = 2; k <= sqrt(a->length); k++){
        for(j = 2 * k; j <= a->length; j += k){
            a->data[j - 1] = 1; // Mark all composites
        }
	}
}

void print_arr(struct master_array *a)
{
	int i;
	printf("Primes are");
	for(i = 0; i < a->length; i++){
        if(a->data[i] == 0){
            printf(" %d", i + 1);
            a->primes++;
        }
	}
	printf("\nThere were %d total primes\n", a->primes);
}

void free_arr(struct master_array *a){
    if(a->data != 0){
        free(a->data);
        a->data = NULL;
    }
    free(a);
}