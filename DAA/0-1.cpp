#include <stdio.h>
#include <math.h> // For log function

// Function to compute GCD using the Euclidean Algorithm
// Also counts the number of steps
int gcd(int a, int b, int *steps) {
    while (b != 0) {
        (*steps)++; // Increment step counter
        int remainder = a % b; // Compute the remainder
        a = b;                 // Replace a with b
        b = remainder;         // Replace b with the remainder
    }
    return a; // When b == 0, a is the GCD
}

int main() {
    int num1, num2;

    // Input two numbers
    printf("Enter two integers: ");
    scanf("%d %d", &num1, &num2);

    int steps = 0; // Initialize step counter
    int result = gcd(num1, num2, &steps); // Compute GCD

    // Output the result and the number of steps
    printf("GCD of %d and %d is %d\n", num1, num2, result);
    printf("Number of steps taken: %d\n", steps);

    // Theoretical time complexity: O(log(min(a, b)))
    int min_value = (num1 < num2) ? num1 : num2; // Find the smaller number
    double log_min_value = log(min_value); // Natural logarithm of min(a, b)
    printf("Theoretical time complexity: O(log(min(%d, %d))) = O(log(%d)) ≈ %.2f\n", num1, num2, min_value, log_min_value);

    return 0;
}