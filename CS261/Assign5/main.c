#include <stdio.h>
#include <stdlib.h>
#include <assert.h>
#include <string.h>
#include "toDoList.h"

int main (int argc, const char * argv[])
{
	Task* newTask;
	Task* firstTask;
	char desc[TASK_DESC_SIZE], filename[50], *nlptr;
	int priority;
	char cmd = ' ';
	FILE *filePointer;
	DynArr* mainList = createDynArr(10);
	
	printf("\n\n** TO-DO LIST APPLICATION **\n\n");

	do 
	{
	printf("Press:\n"
			"'l' to load to-do list from a file\n"
			"'s' to save to-do list to a file\n"
			"'a' to add a new task\n"
			"'g' to get the first task\n"
			"'r' to remove the first task\n"
			"'p' to print the list\n"
			"'e' to exit the program\n"
			);
	/* get input command (from the keyboard) */
	cmd = getchar();
	/* clear the trailing newline character */
	while (getchar() != '\n');	
	
	switch (cmd)
   	{
		case 'a': /* add new task */
			printf("Please enter the task description: ");
			/* get task description from user input (from keyboard) */
			if (fgets(desc, sizeof(desc), stdin) != NULL)
			{
			  	/* remove trailing newline character */
				nlptr = strchr(desc, '\n');
				if (nlptr) 
					*nlptr = '\0';
			}
			/* get task priority from user input (from keyboard) */
			do {
				printf("Please enter the task priority (0-999): ");
				scanf("%d", &priority);
			} while(!(priority >= 0 && priority <= 999));
			
			/* clear the trailing newline character */
			while (getchar() != '\n');
			
			/* create task and add the task to the heap */
			newTask = createTask(priority, desc);
			addHeap(mainList, newTask);
			printf("The task '%s' has been added to your to-do list.\n\n", desc);
	  		break;
		
	   	case 'g': /* get the first task */
		  	if (sizeDynArr(mainList) > 0) 
			{
				firstTask = (Task*)getMinHeap(mainList);
				printf("Your first task is: %s\n\n", firstTask->description);
			}
			else
				printf("Your to-do list is empty!\n\n");
	  		
			break;

		case 'r': /* remove the first task */
		  if (sizeDynArr(mainList) > 0) 
			{
				firstTask = (Task*)getMinHeap(mainList);
				removeMinHeap(mainList);
				printf("Your first task '%s' has been removed from the list.\n\n", firstTask->description);
				/* need to free up memory occupied by this task */
				free(firstTask);
			}
			else
				printf("Your to-do list is empty!\n\n");
	  		
			break;
		
		case 'p': /* print the list */
		  if (sizeDynArr(mainList) > 0) 
			{
			  	printList(mainList);				
			}
			else
				printf("Your to-do list is empty!\n\n");
	  		
			break;


		case 's': /* save the list to file */
			if (sizeDynArr(mainList) > 0)
			{ 
			  	/* get filename from user input (from keyboard) */
				printf("Please enter the filename: ");
				if (fgets(filename, sizeof(filename), stdin) != NULL)
				{
			  		/* remove trailing newline character */
					nlptr = strchr(filename, '\n');
					if (nlptr) 
						*nlptr = '\0';
				}
				/* open the file */
				filePointer = fopen(filename, "w");	
				if (filePointer == NULL) {
			  		fprintf(stderr, "Cannot open %s\n", filename);
					break;
				}
				/* save the list to the file */
				saveList(mainList, filePointer);
				/* close the file */
				fclose(filePointer);
				printf("The list has been saved into the file successfully.\n\n");			
			}
			else
				printf("Your to-do list is empty!\n\n");
			
			break;
		
		case 'l': /* load the list from the file */
	  	  	printf("Please enter the filename: ");
			/* get filename from user input (from keyboard) */
			if (fgets(filename, sizeof(filename), stdin) != NULL)
			{
		  		/* remove trailing newline character */
				nlptr = strchr(filename, '\n');
				if (nlptr) 
					*nlptr = '\0';
			}
			/* open the file */
			filePointer = fopen(filename, "r");	
			if (filePointer == NULL) {
		  		fprintf(stderr, "Cannot open %s\n", filename);
				break;
			}
			/* load the list from the file */
			loadList(mainList, filePointer);
			/* close the file */
			fclose(filePointer);
			printf("The list has been loaded from file successfully.\n\n");			
			break;
		
		case 'e': /* exit the program */
		  	printf("Bye!\n\n");
			break;
		
		default: 
			printf("What is your command anyway?\n\n" );
			break;
	}
	} 
	while(cmd != 'e');
	/* delete the list */
	deleteList(mainList);	

	return 0;
}
