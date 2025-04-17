#include <stdio.h>
#include <stdlib.h>
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
int is_primitive_root(int g, int p) {
    int values[p - 1]; 
    int found[p - 1];  
    for (int i = 0; i < p - 1; i++)
        found[i] = 0;
    for (int i = 0; i < p - 1; i++) {
        values[i] = power(g, i + 1, p); 
        if (found[values[i] - 1] == 1) 
            return 0;
        found[values[i] - 1] = 1;
    }
    for (int i = 0; i < p - 1; i++) {
        if (found[i] == 0) return 0;
    }
    return 1; 
}
void find_primitive_roots(int p) {
    printf("Primitive roots of %d are: ", p);
    int count = 0;
    for (int g = 2; g < p; g++) {
        if (is_primitive_root(g, p)) {
            printf("%d ", g);
            count++;
        }
    }
    if (count == 0)
        printf("None found.");
    printf("\n");
}
int main() {
    int p;
    printf("Enter a prime number: ");
    scanf("%d", &p);
    if (p <= 1) {
        printf("Invalid input! Please enter a prime number greater than 1.\n");
        return 1;
    }
    find_primitive_roots(p);
        printf("Samyak Manandhar 79010513");
    return 0;
}
