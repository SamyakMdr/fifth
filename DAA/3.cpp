#include <stdio.h>
#include <stdlib.h>
#include <time.h>

int search(int arr[], int size, int target) {
    int steps = 0;
    for (int i = 0; i < size; i++) {
        steps++;
        if (arr[i] == target) {
            printf("Target found at index %d\n", i);
            printf("Number of steps: %d\n", steps);
            return i;
        }
    }
    printf("Target not found\n");
    printf("Number of steps: %d\n", steps);
    return -1;
}

int generateRandom(int lower, int upper) {
    return (rand() % (upper - lower + 1)) + lower;
}

int main() {
    int arr[20];
    int target;
    char choice;
    srand(time(0));

    do {
        printf("Generated Array: ");
        for (int i = 0; i < 10; i++) {
            arr[i] = generateRandom(1, 100);
            printf("%d ", arr[i]);
        }
        printf("\nEnter the number to search: ");
        scanf("%d", &target);
        search(arr, 20, target);
        printf("Do you want to search again? (y/n): ");
        scanf(" %c", &choice);
    } while (choice == 'y' || choice == 'Y');

    printf("Exiting the program!\n");
    return 0;
}
