/* 	dynArr.h : Dynamic Array implementation. */
#ifndef DYNAMIC_ARRAY_INCLUDED
#define DYNAMIC_ARRAY_INCLUDED 1
#include "type.h"

# ifndef TYPE
# define TYPE      void*
# endif

/* function used to compare two TYPE values to each other, define this in your compare.c file */
int compare(TYPE left, TYPE right);
/* function used to print TYPE values, define this in your compare.c file */
void print_type(TYPE curval);

typedef struct DynArr DynArr;
struct bag;

/* Dynamic Array Functions */
DynArr *createDynArr(int cap);
void deleteDynArr(DynArr *v);

int sizeDynArr(DynArr *v);

void addDynArr(DynArr *v, TYPE val);
TYPE getDynArr(DynArr *v, int pos);
void putDynArr(DynArr *v, int pos, TYPE val);
void swapDynArr(DynArr *v, int i, int  j);
void removeAtDynArr(DynArr *v, int idx);

/* Stack interface. */
int isEmptyDynArr(DynArr *v);
void pushDynArr(DynArr *v, TYPE val);
TYPE topDynArr(DynArr *v);
void popDynArr(DynArr *v);

/* Bag Interface */
int containsDynArr(DynArr *v, TYPE val);
void removeDynArr(DynArr *v, TYPE val);


/* Heap-based Priority Queue Interface */
TYPE getMinHeap(DynArr *heap);
void addHeap(DynArr *heap, TYPE node);
void removeMinHeap(DynArr *heap);
void sortHeap(DynArr *heap);


/* Utility function*/
void copyDynArr(DynArr *source, DynArr *destination);


#endif
