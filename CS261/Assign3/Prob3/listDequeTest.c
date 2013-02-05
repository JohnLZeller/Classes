#include "cirListDeque.h"
#include <stdio.h>

int main(){
	printf("createCirListDeque()...\n");
	struct cirListDeque* q = createCirListDeque();
	addBackCirListDeque(q, (TYPE)1);
	addBackCirListDeque(q, (TYPE)2);
	addBackCirListDeque(q, (TYPE)3);
	addFrontCirListDeque(q, (TYPE)4);
	addFrontCirListDeque(q, (TYPE)5);
	addFrontCirListDeque(q, (TYPE)6);
	printf("printCirListDeque(q)...\n");
	printCirListDeque(q);
	printf("frontCirListDeque(q)...\n");
	printf("%g\n", frontCirListDeque(q));
	printf("backCirListDeque(q)...\n");
	printf("%g\n", backCirListDeque(q));
	printf("removeFrontCirListDeque(q)...\n");
	removeFrontCirListDeque(q);
	printf("removeBackCirListDeque(q)...\n");
	removeBackCirListDeque(q);
	printf("printCirListDeque(q)...\n");
	printCirListDeque(q);
	printf("reverseCirListDeque(q)...\n");
	reverseCirListDeque(q);
	printf("printCirListDeque(q)...\n");
	printCirListDeque(q);
	printf("deleteCirListDeque(q)...\n");
	deleteCirListDeque(q);
	return 0;
}