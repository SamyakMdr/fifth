#include <stdio.h>
#include <stdlib.h>
#include <time.h>
#include <math.h>
#include <string.h>
#define LL long long int
LL gcd(LL a, LL b) {
    return (b == 0) ? a : gcd(b, a % b);
}
LL mod_exp(LL base, LL exp, LL mod) {
    LL res = 1;
    base = base % mod;
    while (exp > 0) {
        if (exp % 2 == 1)
            res = (res * base) % mod;
        base = (base * base) % mod;
        exp /= 2;
    }
    return res;
}
LL mod_inv(LL a, LL m) {
    LL m0 = m, t, q;
    LL x0 = 0, x1 = 1;
    if (m == 1) return 0;
    while (a > 1) {
        q = a / m;
        t = m;
        m = a % m, a = t;
        t = x0;
        x0 = x1 - q * x0;
        x1 = t;
    }
    if (x1 < 0) x1 += m0;
    return x1;
}
LL gen_key(LL q) {
    LL key = rand() % (q - 2) + 2; // Ensure key is in valid range
    while (gcd(q, key) != 1)
        key = rand() % (q - 2) + 2;
    return key;
}
void encrypt(char* msg, LL q, LL h, LL g, LL* en_msg, int size, LL* p) {
    LL k = gen_key(q);
    LL s = mod_exp(h, k, q);
    *p = mod_exp(g, k, q);
    printf("g^k used: %lld\n", *p);
    printf("g^ak used: %lld\n", s);
    for (int i = 0; i < size; i++) {
        en_msg[i] = (msg[i] * s) % q;
    }
}
void decrypt(LL* en_msg, LL p, LL key, LL q, char* dr_msg, int size) {
    LL s = mod_exp(p, key, q);
    LL s_inv = mod_inv(s, q); 
    for (int i = 0; i < size; i++) {
        dr_msg[i] = (en_msg[i] * s_inv) % q;
    }
    dr_msg[size] = '\0';
}
int main() {
    srand(time(0));
    char msg[100];
    printf("Enter the message: ");
    fgets(msg, sizeof(msg), stdin);
    msg[strcspn(msg, "\n")] = '\0';
    printf("Original Message: %s\n", msg);
    LL q = 7919;
    LL g = rand() % (q - 2) + 2;
    LL key = gen_key(q);
    LL h = mod_exp(g, key, q);
    printf("g used: %lld\n", g);
    printf("g^a used: %lld\n", h);
    int size = strlen(msg);
    LL en_msg[size];
    LL p;
    encrypt(msg, q, h, g, en_msg, size, &p);
    printf("Encrypted Message: ");
    for (int i = 0; i < size; i++)
        printf("%lld ", en_msg[i]);
    printf("\n");
    char dr_msg[size + 1];
    decrypt(en_msg, p, key, q, dr_msg, size);
    printf("Decrypted Message: %s\n", dr_msg);
    return 0;
}
