#include<stdio.h>
int S1[4][16]={ 
{14,4,13,1,2,15,11,8,3,10,6,9,0,7,5,12},
{15,12,1,16,9,14,11,3,6,13,0,4,2,7,5,8},
{2,9,13,7,10,6,3,5,15,14,12,11,1,0,8,4},
{3,13,7,2,12,14,9,11,6,10,1,5,4,8,15,0}
};
void getRowandColumn(int input,int *row,int *col){
*row=((input>>5)&0x1)*2+((input>>0)&0x1);
*col=(input>>1)&0xF;
}
int SboxOutput(int input){
int row,col;
getRowandColumn(input,&row,&col);
return S1[row][col];
}
int main(){
int input,output;
printf("SAMYAK MANANDHAR 79010513\n");
printf("Enter a 6-bit number(decimal): ");
scanf("%d",&input);
if(input<0 || input>63){
printf("Invalid input! Enter a number between 0 and 63.\n");
return -1;
}
output=SboxOutput(input);
printf("The S-Box (S1) output for intput %d: %d", input, output);
return 0;
}