#include<stdio.h>

int gcdIterative(int a, int b){
	while(b != 0){
		int temp = b;
		b = a % b;
		a = temp;
	}
	return a;
}

int are_relatively_prime(int a, int b){
	return gcdIterative(a,b) == 1;
}

int main(){
	int num1, num2;
	
	printf("enter first numbers:");
	scanf("%d", &num1);
	printf("enter second numbers:");
	scanf("%d", &num2);
	
	if (are_relatively_prime(num1, num2)){
		printf("%d and %d are relatively prime.\n",num1, num2);
	}else{
		printf("%d and %d are not relatively prime.\n",num1, num2);
	}
	printf("Samyak Manandhar 79010513");
	return 0;
}

