#include<stdio.h>

int extended_gcd(int a, int b, int *x, int *y){
	int x1, y1;
	int q, r;
	int old_x = 1, old_y = 0;
	int current_x = 0, current_y = 1;
	
	printf("%-10s %-10s %-10s %-10s %-10s\n","q", "r", "x", "y", "gcd");
	while (b !=0 ){
		q = a / b;
		r = a % b;
		
		x1 = old_x - q * current_x;
		y1 = old_y - q * current_y;
		
		printf("%-10d %-10d %-10d %-10d %-10d\n",q ,r ,x1, y1, b);
		
		old_x = current_x;
		old_y = current_y;
		current_x = x1;
		current_y = y1;
		
		a = b;
		b = r;
	} 
	*x = old_x;
	*y = old_y;
	return a;
}

void mod_inverse(int a, int n){
	int x, y;
	int gcd = extended_gcd(a,n, &x, &y);
	if (gcd != 1){
		printf("\n Multiplicative inverse does not exist (GCD is not 1).\n");
	}else {
		int inverse = (x % n + n) % n;
		printf("Multiplicative Inverse of %d modulo %d is: %d\n", a, n, inverse);
	}
}


int main(){
	int a, n;
	printf("Enter a number and modulo n: ");
	scanf("%d%d",&a, &n);
	
	mod_inverse(a, n);
	printf("Samyak Manandhar 79010513");
	return 0;
}