#include <stdio.h>
#include <stdlib.h>
#include <time.h>
void insertionSort(int arr[], int n) {
    int i, key, j, shifts = 0;
    for (i = 1; i < n; i++) {
        key = arr[i];
        j = i - 1;
        while (j >= 0 && arr[j] > key) {
            arr[j + 1] = arr[j];
            j--;
            shifts++;
        }
        arr[j + 1] = key;
    }
    printf("Sorted Array: ");
    for (i = 0; i < n; i++) {
        printf("%d ", arr[i]);
    }
    printf("\nNumber of shifts: %d\n", shifts);
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
        insertionSort(arr, 10);
        printf("Do you want to sort another array? (y/n): ");
        scanf(" %c", &choice);
    } while (choice == 'y' || choice == 'Y');
    printf("Exiting the program!\n");
    return 0;
}
