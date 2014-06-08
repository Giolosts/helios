#include <stdio.h>

float compute(float kwh) {
	float price[13] = {5.6673, 0.0314, 0, 0.9333, 0.6062,
					   1.5789, 0.4066, 0.6043, 0.1173, 0.0001,
					   0.1561, 0.0025, 0.1938};
	float category[5] = {0, 0, 0, 0, 0};
	float total;
	int p = 0, c = 0, i;
	
	// generation
	for(i = 0; i < 3; i++) {
		category[c] += kwh * price[p];
		p++; //next price
	} 
	printf("\nGeneration: %.2f", category[c]);
	c++; // next categ
	
	// transmission
	category[c] = kwh * price[p];
	printf("\nTransmission: %.2f", category[c]);
	p++; c++;
	
	// system loss
	category[c] = kwh * price[p];
	printf("\nSystem Loss: %.2f", category[c]);
	p++; c++;
	
	// distribution
	for(i = 0; i < 3; i++) {
		category[c] += kwh * price[p];
		p++;
	}
	
	category[c] += 24.88; // fixed prices
	printf("\nDistribution: %.2f", category[c]);
	c++;	
	
	// subsidies
	for(i = 0; i < 2; i++) {
		category[c] += kwh * price[p];
		p++;
	}
	printf("\nSubsidies: %.2f", category[c]);
	c++;
	
	// universal charges
	for(i = 0; i < 3; i++) {
		category[c] += kwh * price[p];
		p++;
	}
	printf("\nUniversal Charges: %.2f", category[c]);
	c++;
	
	// subtotal
	for(i = 0; i < c; i++) {
		total += category[i];
	}
	printf("\nSubtotal (no taxes): %.2f", total);
	// government taxes
	total += 241.28;
	
	return total;
}

float fluctuation (float monthly_bill) {


}

int main() {
	float kwh, daily_kwh, monthly_bill, budget, kw, 
	generated_kwh, monthly_generated, generated_bill = 0,
	monthly_saved, emissions, new_emissions, new_co2, new_average_bill,
	average_monthly_savings = 0;
	float monthly_savings[12] = {0};
	float solar_monthly_bills[12] = {0};
	float solar_insolation[12] = {.92, .80, .66, .58,
								  .66, .97, 1.07, 1.06,
								  1.07, .98, 1, 1};
	int i = 0;
	
	printf("Hi, please enter your monthly kWh: ");
	scanf("%f", &kwh);
	
	monthly_bill = compute(kwh); // computes meralco bill
	printf("\nAverage monthly bill: %.2f", monthly_bill);
	
	daily_kwh = kwh / 30;
	
	printf("\nYour average daily kWh usage is %.2fkWh", daily_kwh);
	
	emissions = kwh * 12; // computes yearly emissions
	
	printf("\nCurrently, your CO2 emmisions are %.0f CO2 pounds per year", emissions);
	
	printf("\n\nWhat is your budget for solar panels? ");
	scanf("%f", &budget);
	
	kw = budget / 100000; // 1kw == 100000 pesos
	
	generated_kwh = kw * 4.5; // daily kwh usage; 1kw ~= 4.5 kwh
		
	printf("Average kWh from solar panels daily: %.2f", generated_kwh);
	
	monthly_generated = generated_kwh * 30; // monthly generated kwh
	
	printf("\nAverage kWh from solar panels monthly: %.2f", monthly_generated);
	
	monthly_saved = kw * 1795.33; // constant '1795.33' is based on current data from solar sites
								   // 1kw ~= 1795.33 pesos in savings
	
	for(i = 0; i < 12; i++) { // stores varying monthly SAVINGS in array
		monthly_savings[i] = monthly_saved * solar_insolation[i];
		solar_monthly_bills[i] = monthly_bill - monthly_savings[i]; // stores each months solar bills into array
		average_monthly_savings += monthly_savings[i]; // add all to one var
	}
	
	// user solar_monthly_bills array for displaying in graph
	
	average_monthly_savings /= 12; // get average
	
	printf("\nAverage solar savings per month: %.2f", average_monthly_savings);
	
	new_average_bill = monthly_bill - average_monthly_savings;
	
	printf("\nYour new average monthly bill is: %.2f", new_average_bill);
	
	new_emissions = emissions - (kwh - monthly_generated) * 12;
	printf("\nYour new  CO2 emmisions is %.0f CO2 pounds per year", emissions - new_emissions);
	
	// for(i = 0; i < 12; i++)
	//	monthly_fluctuation[i] = solar_insolation[i] * generated_bill; // computes monthly fluctuation of solar panel output
	
	printf("\n");
//	
	for(i = 0; i < 12; i++)
		printf("%.2f,", solar_monthly_bills[i]);
		
	return 0;
}
