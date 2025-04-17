#include<stdio.h>
int additiveInverse(int a, int n){
	int inverse = (n - (a % n)) % n;
	return inverse;
}

int main(){
	int a, n;
	
	printf("Enter a number: ");
	scanf("%d", &a);
	printf("Enter a modulo n: ");
	scanf("%d", &n);
	
	if (n <= 0){
		printf("Modulo n must be greater than zero.\n");
		return 1;
	}	
	
	int result = additiveInverse(a, n);
	printf("The additive inverse of %d modulo %d is: %d\n", a, n, result);
	printf("Samyak Manandhar 79010513");
	return 0;
}
