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

void heapify(int arr[], int n, int i) {
    int largest = i;
    int l = 2*i + 1;
    int r = 2*i + 2;

    if (l < n && arr[l] > arr[largest])
        largest = l;

    if (r < n && arr[r] > arr[largest])
        largest = r;

    if (largest != i) {
        swap(&arr[i], &arr[largest]);
        heapify(arr, n, largest);
    }
}

void heapSort(int arr[], int n) {
    for (int i = n / 2 - 1; i >= 0; i--)
        heapify(arr, n, i);

    for (int i = n - 1; i > 0; i--) {
        swap(&arr[0], &arr[i]);
        heapify(arr, i, 0);
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

        heapSort(arr, 10);

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
