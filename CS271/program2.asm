TITLE Fibonnaci Numbers			(program2.asm)

; Program Description: 
;	1) Getting string input
;	2) Designing and implementing a counted loop
;	3) Designing and implementing a post-test loop
;	4) Keeping track of a previous value
;	5) Implementing data validation
; Author: John Zeller
; Date Created: 4/20/2013
; Last Modification Date: 4/20/2013

INCLUDE Irvine32.inc

.data
titleMsg BYTE "Fibonacci Numbers",13,10
		 BYTE "Programmed by John L. Zeller",13,10,13,10
		 BYTE "What's your name? ",0
helloMsg BYTE "Hello, ",0
instructionsMsg BYTE "Enter the number of Fibonacci terms to be displayed",13,10
				BYTE "Give the number as an integer in the range [1 .. 46].",13,10,0
askMsg BYTE "How many Fibonacci terms do you want? ",0
errorMsg BYTE "Out of range. Enter a number in [1 .. 46]",13,10,0
tabMsg BYTE " ",9,0

nameBuffer BYTE 21 DUP(0)

goodbyeMsg BYTE "Results certified by John L. Zeller.",13,10,"Goodbye, ",0

.data?
numTerms DWORD ?
secondTerm DWORD ?
sum DWORD ?
columnCount DWORD ?

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
		cmp eax, 1
		jl falseBlock
		cmp eax, 46
		jg falseBlock
		jmp done
	falseBlock:
		mov edx, OFFSET errorMsg
		call WriteString
		jmp askLoop
	done:
		call Crlf
		mov numTerms, eax
		mov eax, 00000000h

	; CALCULATIONS/PRINTING
	mov eax, 1
	call WriteDec	; Write current Fibonacci Sum
	mov edx, OFFSET tabMsg
	call WriteString	
	mov eax, 0			; Fibonacci Sum - n
	mov ebx, 1			; First Term - (n-1)
	mov secondTerm, 0	; Second Term - (n-2)
	mov ecx, numTerms	; Loop Counter
	dec ecx				; Decrement loop counter 1 since first term is already calculated
	mov columnCount, 2	; Count the number of columns. Starts at 2 because of first term already
	fibLoop:
		; eax = (n-1)+(n-2)
		mov eax, ebx
		add eax, secondTerm
		; (n-2) = (n-1)
		mov secondTerm, ebx
		; inc (n-1)
		mov ebx, eax
		call WriteDec	; Write current Fibonacci Sum
		mov edx, OFFSET tabMsg
		call WriteString
		cmp columnCount, 5
		jge trueBlock
		mov edx, 00000000h
		mov edx, columnCount
		inc edx
		mov columnCount, edx
		jmp fBlock
		trueBlock:
			call Crlf
			mov columnCount, 1
		fBlock:
		loop fibLoop
		
	
	; TERMINATING MESSAGE
	call Crlf
	call Crlf
	mov edx, OFFSET goodbyeMsg	; Prepare message
	call WriteString			; Print to console

	exit		; exit to operating system
main ENDP

END main