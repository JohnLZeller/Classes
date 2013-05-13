TITLE Integer Accumulator			(program3.asm)

; Program Description:
;	1) Display the program title and programmer’s name.
;	2) Get the user’s name, and greet the user.
;	3) Display instructions for the user.
;	4) Repeatedly prompt the user to enter a number. Validate the user input to be less than or equal to 100. 
;		Count and accumulate the valid user numbers until a negative number is entered. (The negative 
;		number is discarded.)
;	5) Calculate the (rounded integer) average of the non-negative numbers.
;	6) Display:
;		i) the number of non-negative numbers entered (Note: if no non-negative numbers were entered, 
;			display a special message and skip to iv.)
;		ii) the sum of non-negative numbers entered
;		iii) the average rounded to the nearest integer
;		iv) a parting message (with the user’s name)
; Author: John Zeller
; Date Created: 5/1/2013
; Last Modification Date: 5/1/2013

INCLUDE Irvine32.inc

.data
titleMsg BYTE "Welcome to the Integer Accumulator by John Zeller",13,10
		 BYTE "What's your name? ",0
helloMsg BYTE "Hello, ",0
instructionsMsg BYTE "Please enter numbers less than or equal to 100.",13,10
				BYTE "Enter a negative number when you are finished to see results.",13,10,0
askMsg BYTE "Enter number: ",0
enteredMsg1 BYTE "You entered ",0
enteredMsg2 BYTE " numbers.",0
sumMsg BYTE "The sum of your numbers is ",0
roundMsg BYTE "The rounded average is ",
errorMsg BYTE "ERROR: Enter a number that is less than or equal to 100.",13,10,0
tabMsg BYTE " ",9,0

nameBuffer BYTE 21 DUP(0)

goodbyeMsg1 BYTE "Thank you for playing Integer Accumulator! It's been a pleasure to meet you, ",0
goodbyeMsg2 BYTE ".",0

.data?
number DWORD ?
total DWORD ?
quantity DWORD ?
sum DWORD ?
average DWORD ?

.code
main PROC
	; TITLE/GREETING
	COMMENT !
		This section writes the title and author of
		the program to the console.
	!
	mov edx, OFFSET titleMsg
	call WriteString
	mov edx, OFFSET nameBuffer
	mov ecx, SIZEOF nameBuffer
	call ReadString
	mov edx, OFFSET helloMsg
	call WriteString
	mov edx, OFFSET nameBuffer
	call WriteString
	call Crlf
	mov edx, 00000000h	; Clears EDX
	
	; INSTRUCTIONS
	COMMENT !
		This section writes the instructions for the
		user to the console.
	!
	mov edx, OFFSET instructionsMsg
	call WriteString
	call Crlf
	call Crlf
	
	; REQUEST/READ
	COMMENT !
		This section requests and reads the first and
		second integers needed from the user. The
		integers are then saved into their respective
		variables.
	!
	; Request/Read integer and Data validation
	askLoop:
		mov edx, OFFSET askMsg
		call WriteString
		call ReadInt
		; Check if number > 100 or < 0
		cmp eax, 100
		jg falseBlock
		cmp eax, 0
		jl done
		; If the number makes it past these things, 
		; then calc, save and restart loop
		jmp calcBlock
	falseBlock:
		; If number > 100, then print error and restart loop without calc
		mov edx, OFFSET errorMsg
		call WriteString
		jmp askLoop
	calcBlock:
		mov number, eax		; Save eax to number
		mov eax, total
		add eax, number		; Add number to total
		mov total, eax
		jmp askLoop
	done:
		; If number < 0, then exit loop and print calculations
		call Crlf
		;mov numTerms, eax
		;mov eax, 00000000h
	
	; TERMINATING MESSAGE
	mov edx, OFFSET goodbyeMsg	; Prepare message
	call WriteString			; Print to console

	exit		; exit to operating system
main ENDP

END main