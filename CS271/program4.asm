TITLE Prime Numbers			(program4.asm)

; Program Description:
;	This program calculates prime numbers.
;	1) The user is instructed to enter the number of primes to be displayed,
;		and is prompted to enter an integer in the range [1 .. 200].
;	2) The user enters a number, n, and the program verifies that 1 <= n <= 200.
;	3) If n is out of range, the user is re-prompted until s/he enters a
;		value in the specified range.
;	4) The program then calculates and displays the all of the prime numbers
;		up to and including the nth prime.
;	5) The results should be displayed 10 primes per line with at least 3
;		spaces between the numbers.
; Author: John Zeller
; Date Created: 5/10/2013
; Last Modification Date: 5/10/2013

INCLUDE Irvine32.inc

.data
titleMsg BYTE "Prime Numbers",9,"Programmed by John Zeller",13,10,0
instructionsMsg BYTE "Enter the number of prime numbers you would like to see.",13,10
				BYTE "I'll accept orders for up to 200 primes.",13,10,0
askMsg BYTE "Enter the number of primes to display [1 .. 200]: ",0
errorMsg BYTE "Out of range. Try again.",13,10,0
goodbyeMsg BYTE "Results certified by John Zeller. Goodbye.",0
tabMsg BYTE " ",9,0
newLineMsg BYTE " ",13,10,0
showPerLine DWORD 10
upperLimit DWORD 200
lowerLimit DWORD 1
falseFlag DWORD 0
primeFlag DWORD 0
primesShown DWORD 0
currentNumber DWORD 2

.data?
primeNumbers DWORD ?

.code
main PROC
	call introduction
	call getUserData
	call showPrimes
	call farewell

	exit		; exit to operating system
main ENDP

;----------------------------------------------------------------------
introduction PROC USES edx,
; Displays an introduction for the program, programmer and instructions
; for use.
; Receives: Nothing
; Returns: Nothing
;----------------------------------------------------------------------
	mov edx, OFFSET titleMsg
	call WriteString
	call Crlf
	mov edx, OFFSET instructionsMsg
	call WriteString
	call Crlf
	ret
introduction ENDP

;----------------------------------------------------------------------
getUserData PROC USES eax edx,
; Displays a request for User Data. Will show an error message for each
; invalid entry, and repeat until a valid entry is submitted.
; Receives: Nothing
; Returns: Nothing
;----------------------------------------------------------------------
	askLoop:
		mov edx, OFFSET askMsg
		call WriteString
		call ReadInt
		mov primeNumbers, eax
		call validate
		; If falseFlag is set, then start loop again
		cmp falseFlag, 1
		je askLoop
		; Else, done
	done:
		call Crlf
		ret
getUserData ENDP

;----------------------------------------------------------------------
validate PROC USES eax edx,
; Checks to see that user data is within the valid range.
; Receives: Nothing
; Returns: Nothing
;----------------------------------------------------------------------
	; Check that the number entered is between 1 and 200
	mov eax, primeNumbers
	cmp eax, lowerLimit
	jl falseBlock
	cmp eax, upperLimit
	jg falseBlock
	; If the number makes it past these things, then jump to done
	jmp done
	falseBlock:
		; Print error and set false flag
		mov edx, OFFSET errorMsg
		call WriteString
		mov falseFlag, 1
		ret
	done:
		; Make sure the falseFlag is cleared
		mov falseFlag, 0
		ret
validate ENDP

;----------------------------------------------------------------------
showPrimes PROC USES eax,
; Displays all primes, as it calculates them.
; Receives: Nothing
; Returns: Nothing
;----------------------------------------------------------------------
	mov eax, primeNumbers
	cmp eax, 1
	je onesCase
	primeLoop:
		mov primeFlag, 0	; Reset primeFlag
		call isPrime
		; If primeFlag is set, then print currentNumber
		cmp primeFlag, 1
		je displayPrime
		; Else, continue
		inc currentNumber	; Set currentNumber to the next number up
		; If primesShown < primeNumbers, then continue
		mov eax, primesShown
		cmp eax, primeNumbers
		jl primeLoop
		; Else,
		jmp done
	displayPrime:
		mov eax, 00000000h	; Reset EAX
		mov eax, currentNumber
		call WriteDec
		mov edx, OFFSET tabMsg
		call WriteString
		inc primesShown		; Set primesShown to the next number up
		inc currentNumber	; Set currentNumber to the next number up
		; Check if a new line is needed
		mov edx, 00000000h
		mov eax, primesShown
		div showPerLine
		cmp edx, 0
		je newLine
		jmp primeLoop
	newLine:
		call Crlf
		jmp primeLoop
	onesCase:				; Special case that only handles when prime is 1
		mov eax, 00000000h	; Reset EAX
		mov eax, 2
		call WriteDec
	done:
		call Crlf
		call Crlf
		ret
showPrimes ENDP

;----------------------------------------------------------------------
isPrime PROC USES eax ecx edx,
; Checks to see whether a given number is a prime number or not.
; Receives: Nothing
; Returns: Nothing
;----------------------------------------------------------------------
	; Check to see if currentNumber is a prime or not
	mov ecx, 00000000h	; Reset ECX
	mov ecx, currentNumber
	dec ecx				; Because n-1 is where we should start
	primeCheck:
		; If ecx is 1, then jump to done
		cmp ecx, 1
		je finishLoop
		; ECX / currentNumber and check the remainder
		mov edx, 00000000h
		mov eax, currentNumber
		div ecx
		cmp edx, 0
		je done			; If remainder is 0, then ECX is a multiple
		loop primeCheck
	finishLoop:
	; If the loop finishes without jumping to done, then it's prime
	mov primeFlag, 1
	done:
		ret
isPrime ENDP

;----------------------------------------------------------------------
farewell PROC USES edx,
; Displays a farewell message to the user.
; Receives: Nothing
; Returns: Nothing
;----------------------------------------------------------------------
	mov edx, OFFSET goodbyeMsg	; Prepare message
	call WriteString			; Print to console
	call Crlf
	ret
farewell ENDP


END main