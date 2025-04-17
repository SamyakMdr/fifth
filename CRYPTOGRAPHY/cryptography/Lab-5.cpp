#include<stdio.h>

int gcdIterative(int a, int b){
	while(b != 0){
		int temp = b;
		b = a % b;
		a = temp;
	}
	return a;
}

int gcdRecursive(int a, int b){
	if (b==0)
	return a;
	return gcdRecursive(b, a % b);
}

int main(){
	int num1, num2;
	
	printf("enter two numbers:");
	scanf("%d%d", &num1, &num2);
	
	printf("GCD (Iterative) of %d and %d is: %d\n", num1, num2, gcdIterative(num1,num2));
	printf("GCD (Recursive) of %d and %d is: %d\n", num1, num2, gcdRecursive(num1,num2));
	printf("Samyak Manandhar 79010513");
	return 0;
}

