#include <stdlib.h>
#include <stdio.h>
#include <math.h>
#include <string.h>
#define SEED 35791246
int main()
{
   int itr=0;
   double x,y;
   int i,count=0;
   double z;
   double pi;
   printf("Samyak Manandhar 79010513\n");
   printf("Enter the number of iterations used to estimate pi: ");
   scanf("%d",&itr);   
   srand(SEED);
   count=0;
   for ( i=0; i<itr; i++)
    {
      x = (double)rand()/RAND_MAX;
      y = (double)rand()/RAND_MAX;
      z = x*x+y*y;
      if (z<=1.0) 
	  count++;
    }
   pi=(double)count/itr*4;
   printf("Value of PI =  %f",pi);
   return 0;
}
