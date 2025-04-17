#include <stdio.h>
#include <stdlib.h>
#include <time.h>
void selectionSort(int arr[], int n) {
    int i, j, min_idx, temp, swaps = 0;
    for (i = 0; i < n - 1; i++) {
        min_idx = i;
        for (j = i + 1; j < n; j++) {
            if (arr[j] < arr[min_idx]) {
                min_idx = j;
            }
        }
        if (min_idx != i) {
            temp = arr[i];
            arr[i] = arr[min_idx];
            arr[min_idx] = temp;
            swaps++;
        }
    }
    printf("Sorted Array: ");
    for (i = 0; i < n; i++) {
        printf("%d ", arr[i]);
    }
    printf("\nNumber of swaps: %d\n", swaps);
}
int generateRandom(int lower, int upper) {
    return (rand() % (upper - lower + 1)) + lower;
}
int main() {
    int arr[10];
    char choice;
    srand(time(0));
    do {
        printf("Original Array: ");
        for (int i = 0; i < 10; i++) {
            arr[i] = generateRandom(1, 100);
            printf("%d ", arr[i]);
        }
        printf("\n");
        selectionSort(arr, 10);
        printf("Do you want to sort another array? (y/n): ");
        scanf(" %c", &choice);
    } while (choice == 'y' || choice == 'Y');
    printf("Exiting the program!\n");
    return 0;
}
