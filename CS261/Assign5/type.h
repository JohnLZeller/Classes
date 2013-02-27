/* You can modify the structure to store whatever you'd like in your dynamic array.
We define struct Task for the to-do list application in this example */

#ifndef __TYPE_H
#define __TYPE_H

#define TASK_DESC_SIZE 128

struct Task {
	char description[TASK_DESC_SIZE];  	/* description of the task */
	int priority;			  			/* task priority */
};

typedef struct Task Task;

#endif
