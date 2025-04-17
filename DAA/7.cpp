#include <stdio.h>
#include <stdlib.h>
#include <time.h>

int swaps = 0;

void swap(int *a, int *b) {
    int t = *a;
    *a = *b;
    *b = t;
    swaps++;
}

int partition(int arr[], int low, int high) {
    int pivot = arr[high]; 
    int i = low - 1;

    for (int j = low; j < high; j++) {
        if (arr[j] < pivot) {
            i++;
            swap(&arr[i], &arr[j]);
        }
    }

    swap(&arr[i + 1], &arr[high]);
    return i + 1;
}

void quickSort(int arr[], int low, int high) {
    if (low < high) {
        int pi = partition(arr, low, high);
        quickSort(arr, low, pi - 1);
        quickSort(arr, pi + 1, high);
    }
}

int generateRandom(int lower, int upper) {
    return (rand() % (upper - lower + 1)) + lower;
}

int main() {
    int arr[10];
    char choice;
    srand(time(0));

    do {
        swaps = 0;
        printf("Original Array: ");
        for (int i = 0; i < 10; i++) {
            arr[i] = generateRandom(1, 100);
            printf("%d ", arr[i]);
        }
        printf("\n");

        quickSort(arr, 0, 9);

        printf("Sorted Array: ");
        for (int i = 0; i < 10; i++) {
            printf("%d ", arr[i]);
        }
        printf("\nNumber of swaps: %d\n", swaps);

        printf("Do you want to sort another array? (y/n): ");
        scanf(" %c", &choice);
    } while (choice == 'y' || choice == 'Y');

    printf("Exiting the program!\n");
    return 0;
}
