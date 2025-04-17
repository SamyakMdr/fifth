#include <stdio.h>
#include <stdlib.h>
#define SIZE 100
typedef struct Node {
    char data;
    int freq;
    struct Node *left, *right;
} Node;
Node* createNode(char data, int freq) {
    Node* n = (Node*)malloc(sizeof(Node));
    n->data = data;
    n->freq = freq;
    n->left = n->right = NULL;
    return n;
}
void printCodes(Node* root, int arr[], int top, int* loopCount) {
    if (root->left) {
        (*loopCount)++;
        arr[top] = 0;
        printCodes(root->left, arr, top + 1, loopCount);
    }
    if (root->right) {
        (*loopCount)++;
        arr[top] = 1;
        printCodes(root->right, arr, top + 1, loopCount);
    }
    if (!root->left && !root->right) {
        printf("%c: ", root->data);
        for (int i = 0; i < top; i++) printf("%d", arr[i]);
        printf("\n");
    }
}
Node* buildHuffmanTree(char data[], int freq[], int n, int* loopCount) {
    Node* heap[SIZE];
    int size = n;
    for (int i = 0; i < n; i++) {
        heap[i] = createNode(data[i], freq[i]);
        (*loopCount)++;
    }
    while (size > 1) {
        int min1 = 0, min2 = 1;
        (*loopCount)++;
        if (heap[min2]->freq < heap[min1]->freq) {
            int temp = min1; min1 = min2; min2 = temp;
        }
        for (int i = 2; i < size; i++) {
            (*loopCount)++;
            if (heap[i]->freq < heap[min1]->freq) {
                min2 = min1;
                min1 = i;
            } else if (heap[i]->freq < heap[min2]->freq) {
                min2 = i;
            }
        }
        Node* left = heap[min1], *right = heap[min2];
        Node* newNode = createNode('-', left->freq + right->freq);
        newNode->left = left;
        newNode->right = right;
        if (min1 < min2) {
            heap[min1] = newNode;
            heap[min2] = heap[size - 1];
        } else {
            heap[min2] = newNode;
            heap[min1] = heap[size - 1];
        }
        size--;
    }
    return heap[0];
}
int main() {
    char data[] = { 'A', 'B', 'C', 'D', 'E', 'F' };
    int freq[] = { 5, 9, 12, 13, 16, 45 };
    int n = sizeof(data) / sizeof(data[0]);
    int arr[100], top = 0;
    int loopCount = 0;
    Node* root = buildHuffmanTree(data, freq, n, &loopCount);
    printf("Huffman Codes:\n");
    printCodes(root, arr, top, &loopCount);
    printf("Number of loops: %d\n", loopCount);
    return 0;
}
