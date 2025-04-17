#include <stdio.h>
long long int power(long long int a, long long int b, long long int mod) {
    long long int result = 1;
    a = a % mod;
    while (b > 0) {
        if (b % 2 == 1)
            result = (result * a) % mod;
        a = (a * a) % mod;
        b /= 2;
    }
    return result;
}
int main() {
    long long int n, g, x, y, A, B;
    printf("Enter the prime number (n) and base (g): ");
    scanf("%lld %lld", &n, &g);
    printf("Enter private key for the first person (x): ");
    scanf("%lld", &x);
    A = power(g, x, n);
    printf("Enter private key for the second person (y): ");
    scanf("%lld", &y);
    B = power(g, y, n);
    long long int key1 = power(B, x, n);
    long long int key2 = power(A, y, n);
    printf("\nPublic Key for First Person (A): %lld\n", A);
    printf("Public Key for Second Person (B): %lld\n", B);
    printf("\nShared Secret Key (Computed by First Person): %lld\n", key1);
    printf("Shared Secret Key (Computed by Second Person): %lld\n", key2);
	if (key1 == key2) {
        printf("\nKey Exchange Successful! Both parties have the same key.\n");
    } else {
        printf("\nError: Keys do not match! Check the implementation.\n");
    }
    printf("Samyak Manandhar 79010513");
    return 0;
}
