#include <stdio.h>
#include <math.h>
long long int power(long long int base, long long int exp, long long int mod) {
    long long int result = 1;
    base = base % mod; 
	while (exp > 0) {
        if (exp % 2 == 1)
            result = (result * base) % mod;
        base = (base * base) % mod; 
		exp /= 2;
    }
    return result;
}
int discrete_log(int g, int y, int p) {
    int m = (int)ceil(sqrt(p));
    int table[m];
    for (int j = 0; j < m; j++)
        table[j] = power(g, j, p);
    int gm = power(g, m * (p - 2), p); 
    int cur = y;
    for (int i = 0; i < m; i++) {
        for (int j = 0; j < m; j++) {
            if (table[j] == cur) {
                return i * m + j;
            }
        }
        cur = (cur * gm) % p;  // Move giant step
    }
    return -1;
}
int main() {
    int g, y, p;
    printf("Enter primitive root (g), number (y), and prime modulus (p): ");
    scanf("%d %d %d", &g, &y, &p);
    int x = discrete_log(g, y, p);
    if (x != -1)
        printf("Discrete Log (x) such that %d^x = %d (mod %d) is: %d\n", g, y, p, x);
    else
        printf("No solution found!\n");
        printf("Samyak Manandhar 79010513");
    return 0;
}
