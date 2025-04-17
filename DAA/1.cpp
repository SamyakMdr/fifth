#include <stdio.h>
#include <stdlib.h>
#include <time.h>
int gcd(int a, int b) {
	int count=0;
    while (b != 0) {
        int temp = b;
        b = a % b;
        a = temp;
        count++;
    }
    printf("Number of counts: %d\n",count);
    return a;
}
int generateRandom(int lower, int upper) {
    return (rand() % (upper - lower + 1)) + lower;
}
int main() {
    int num1, num2;
    char choice;
    srand(time(0));
    do {
        num1 = generateRandom(1, 100);
        num2 = generateRandom(1, 100);
        printf("Generated numbers: %d and %d\n", num1, num2);
        printf("GCD of %d and %d: %d\n", num1, num2, gcd(num1, num2));
        printf("Do you want to find GCD of another pair of numbers? (y/n): ");
        scanf(" %c", &choice);
    } while (choice == 'y' || choice == 'Y');
    printf("Exiting the program!\n");
    return 0;
}

