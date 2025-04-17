#include <stdio.h>
int phi(int n) {
    int result = n;
    for (int p = 2; p * p <= n; p++) {
        if (n % p == 0) {
            while (n % p == 0)
                n /= p;
            result -= result / p;
        }
    }
    if (n > 1)
        result -= result / n;
    return result;
}
int main() {
    int n;
    printf("Enter a positive number: ");
    scanf("%d", &n);    
    if (n <= 0) {
        printf("Invalid input! Enter a positive number.\n");
        return 1;
    }
    printf("f(%d) = %d\n", n, phi(n));
    printf("Samyak Manandhar 79010513\n");

    return 0;
}
