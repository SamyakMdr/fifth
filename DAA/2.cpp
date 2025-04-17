#include <stdio.h>
#include <stdlib.h>
#include <time.h>
void fibonacci(int limit) {
    int a = 0, b = 1, c, count = 0;
    printf("Fibonacci Series up to %d:\n", limit);
    while (a <= limit) {
        printf("%d ", a);
        c = a + b;
        a = b;
        b = c;
        count++;
    }
    printf("\nNumber of terms: %d\n", count);
}
int generateRandom(int lower, int upper) {
    return (rand() % (upper - lower + 1)) + lower;
}
int main() {
    int num;
    char choice;
    srand(time(0));
    do {
        num = generateRandom(10, 100);
        printf("Generated limit: %d\n", num);
        fibonacci(num);
        printf("Do you want to generate another Fibonacci series? (y/n): ");
        scanf(" %c", &choice);
    } while (choice == 'y' || choice == 'Y');
    printf("Exiting the program!\n");
    return 0;
}
