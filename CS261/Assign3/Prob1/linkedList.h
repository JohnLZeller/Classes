#ifndef __LISTDEQUE_H
#define __LISTDEQUE_H

# ifndef TYPE
# define TYPE      int
# define TYPE_SIZE sizeof(int)
# endif
# ifndef LT
# define LT(A, B) ((A) < (B))
# endif

# ifndef EQ
# define EQ(A, B) ((A) == (B))
# endif

struct linkedList;

struct linkedList *createLinkedList();
void deleteLinkedList(struct linkedList *lst);

/* Deque Interface */
int 	isEmptyList(struct linkedList *lst);
void  addBackList(struct linkedList *lst, TYPE e);
void 	addFrontList(struct linkedList *lst, TYPE e);

TYPE  frontList(struct linkedList *lst);
TYPE 	backList(struct linkedList *lst);

void  removeFrontList(struct linkedList *lst);
void 	removeBackList(struct linkedList *lst);

/*Bag Interface */
void addList(struct linkedList *lst, TYPE v);
int containsList(struct linkedList *lst, TYPE e);
void removeList(struct linkedList *lst, TYPE e);

#endif
