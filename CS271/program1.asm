TITLE Elementary Algebra			(program1.asm)

; Program Description: 
;	1) Display your name and program title on the output screen.
;	2) Display instructions for the user.
;	3) Prompt the user to enter two numbers.
;	4) Calculate the sum, difference, product, (integer) quotient and
;		remainder of the numbers.
;	5) Display a terminating message.
; Author: John Zeller
; Date Created: 4/12/2013
; Last Modification Date: 4/12/2013

INCLUDE Irvine32.inc

.data
titleMsg BYTE 9,"Elementary Arithmetic",9,"by John L. Zeller",0
instructionsMsg BYTE "Enter 2 numbers, and I'll show you the sum, "
				BYTE "difference,",13,10,"product, quotient, and "
				BYTE "remainder.",0
firstMsg BYTE "First number: ",0
secondMsg BYTE "Second number: ",0
terminatingMsg BYTE "Thanks! Bye!",13,10,13,10,0
plus BYTE " + ",0
minus BYTE " - ",0
multiply BYTE " x ",0
divide BYTE " ",246," ",0
remainderMsg BYTE " remainder ",0
equal BYTE " = ",0

.data?
number1 DWORD ?
number2 DWORD ?
sum DWORD ?
difference DWORD ?
product DWORD ?
quotient DWORD ?
remainder DWORD ?

.code
main PROC
	; TITLE
	COMMENT !
		This section writes the title and author of
		the program to the console.
	!
	mov edx, OFFSET titleMsg
	call WriteString
	call Crlf
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
	; Request/Read first integer
	mov edx, OFFSET firstMsg
	call WriteString
	call ReadInt	; Reads first integer
	mov number1, eax
	mov eax, 00000000h
	; Request/Read second integer
	mov edx, OFFSET secondMsg
	call WriteString
	call ReadInt	; Reads first integer
	mov number2, eax
	mov eax, 00000000h

	; CALCULATIONS
	COMMENT !
		This section holds all of the calculations for
		add, subtract, multiply, divide and remainder.
		The results are placed into their respective
		variables.
	!
	; Do Calculations - Add
	mov eax, number1
	add eax, number2
	mov sum, eax
	mov eax, 00000000h
	; Do Calculations - Subtract
	mov eax, number1
	sub eax, number2
	mov difference, eax
	mov eax, 00000000h
	; Do Calculations - Mulitply
	mov eax, number1
	mov ebx, number2
	mul ebx
	mov product, eax
	mov eax, 00000000h
	mov ebx, 00000000h
	; Do Calculations - Divide
	mov eax, number1
	cdq
	mov ebx, number2
	div ebx
	mov quotient, eax
	mov remainder, edx
	mov eax, 00000000h
	mov ebx, 00000000h

	; PRINTING RESULTS
	COMMENT !
		This section prints all of the variable values for
		add, subtract, multiply, divide and remainder.
	!
	; Print Results - Add
	mov eax, number1				; Prepare first integer for stdout
	call WriteDec
	mov edx, OFFSET plus			; Prepare " + " for stdout
	call WriteString
	mov eax, number2				; Prepare second integer for stdout
	call WriteDec
	mov edx, OFFSET equal			; Prepare " = " for stdout
	call WriteString
	mov eax, sum					; Prepare sum for stdout
	call WriteDec
	call Crlf
	mov eax, 00000000h
	; Print Results - Subtract
	mov eax, number1				; Prepare first integer for stdout
	call WriteDec
	mov edx, OFFSET minus			; Prepare " - " for stdout
	call WriteString
	mov eax, number2				; Prepare second integer for stdout
	call WriteDec
	mov edx, OFFSET equal			; Prepare " = " for stdout
	call WriteString
	mov eax, difference				; Prepare difference for stdout
	call WriteDec
	call Crlf
	mov eax, 00000000h
	; Print Results - Multiply
	mov eax, number1				; Prepare first integer for stdout
	call WriteDec
	mov edx, OFFSET multiply		; Prepare " x " for stdout
	call WriteString
	mov eax, number2				; Prepare second integer for stdout
	call WriteDec
	mov edx, OFFSET equal			; Prepare " = " for stdout
	call WriteString
	mov eax, product				; Prepare product for stdout
	call WriteDec
	call Crlf
	mov eax, 00000000h
	; Print Results - Divide
	mov eax, number1				; Prepare first integer for stdout
	call WriteDec
	mov edx, OFFSET divide			; Prepare " ÷ " for stdout
	call WriteString
	mov eax, number2				; Prepare second integer for stdout
	call WriteDec
	mov edx, OFFSET equal			; Prepare " = " for stdout
	call WriteString
	mov eax, quotient				; Prepare quotient for stdout
	call WriteDec
	mov edx, OFFSET remainderMsg	; Prepare " remainder " for stdout
	call WriteString
	mov eax, remainder				; Prepare remainder for stdout
	call WriteDec
	call Crlf
	call Crlf
	mov eax, 00000000h
	
	; TERMINATING MESSAGE
	mov edx, OFFSET terminatingMsg	; Prepare message
	call WriteString				; Print to console

	exit		; exit to operating system
main ENDP

END main