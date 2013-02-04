#ifndef __CIRLISTDEQUE_H
#define __CIRLISTDEQUE_H

# ifndef TYPE
# define TYPE      double
# define TYPE_SIZE sizeof(double)
# endif

# ifndef LT
# define LT(A, B) ((A) < (B))
# endif

# ifndef EQ
# define EQ(A, B) ((A) == (B))
# endif

/* struct prototype */
struct cirListDeque;

struct cirListDeque *createCirListDeque();
void deleteCirListDeque(struct cirListDeque *q);

int isEmptyCirListDeque(struct cirListDeque *q);
void addBackCirListDeque(struct cirListDeque *q, TYPE val);
void addFrontCirListDeque(struct cirListDeque *q, TYPE val);
TYPE frontCirListDeque(struct cirListDeque *q);
TYPE backCirListDeque(struct cirListDeque *q);
void removeFrontCirListDeque(struct cirListDeque *q);
void removeBackCirListDeque(struct cirListDeque *q);
void freeCirListDeque(struct cirListDeque *q);

void printCirListDeque(struct cirListDeque *q);
void reverseCirListDeque(struct cirListDeque *q);

#endif
