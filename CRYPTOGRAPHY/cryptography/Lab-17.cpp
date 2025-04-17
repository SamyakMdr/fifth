#include <stdio.h>
#include <stdlib.h>
#include <math.h>
#include <string.h>
long int p, q, n, t, flag, e[100], d[100], temp[100], j, m[100], en[100], i;
char msg[100];
int prime(long int);
void ce();
long int cd(long int);
void encrypt();
void decrypt();
long int mod_exp(long int base, long int exp, long int mod);
int main() {
    printf("ENTER FIRST PRIME NUMBER: ");
    scanf("%ld", &p);
    if (!prime(p)) {
        printf("\nINVALID INPUT! ENTER A PRIME NUMBER.");
        exit(1);
    }
    printf("ENTER ANOTHER PRIME NUMBER: ");
    scanf("%ld", &q);
    if (!prime(q) || p == q) {
        printf("\nINVALID INPUT! ENTER A DIFFERENT PRIME NUMBER.");
        exit(1);
    }
    printf("ENTER MESSAGE: ");
    getchar();
    fgets(msg, sizeof(msg), stdin);
    msg[strcspn(msg, "\n")] = '\0'; 

    for (i = 0; msg[i] != '\0'; i++)
        m[i] = msg[i];
    n = p * q;
    t = (p - 1) * (q - 1);
    ce();
    printf("POSSIBLE VALUES OF e AND d:\n");
    for (i = 0; i < j - 1; i++)
        printf("\ne: %ld\td: %ld", e[i], d[i]);
    encrypt();
    decrypt();
    return 0;
}
int prime(long int pr) {
    if (pr < 2)
        return 0;
    for (long int i = 2; i <= sqrt(pr); i++) {
        if (pr % i == 0)
            return 0;
    }
    return 1;
}
void ce() {
    int k = 0;
    for (i = 2; i < t; i++) {
        if (t % i == 0)
            continue;
        if (prime(i) && i != p && i != q) {
            e[k] = i;
            long int d_val = cd(e[k]);
            if (d_val > 0) {
                d[k] = d_val;
                k++;
            }
            if (k == 99)
                break;
        }
    }
    j = k;
}
long int cd(long int x) {
    long int k = 1;
    while ((k % x) != 0 || (k / x) <= 1) {
        k += t;
    }
    return k / x;
}
long int mod_exp(long int base, long int exp, long int mod) {
    long int res = 1;
    while (exp > 0) {
        if (exp % 2 == 1)
            res = (res * base) % mod;
        base = (base * base) % mod;
        exp /= 2;
    }
    return res;
}
void encrypt() {
    long int key = e[0], len = strlen(msg);
    printf("\nENCRYPTED MESSAGE: ");
    for (i = 0; i < len; i++) {
        temp[i] = mod_exp(m[i], key, n);
        printf("%ld ", temp[i]);
    }
    printf("\n");
}
void decrypt() {
    long int key = d[0];
    printf("DECRYPTED MESSAGE: ");
    for (i = 0; temp[i] != 0; i++) {
        printf("%c", (char)mod_exp(temp[i], key, n));
    }
    printf("\n");
}
