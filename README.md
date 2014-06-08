Helios - (n) God of the Sun
======

This web app lets users project a solar conversion in their home.

- [x] Home front-end
- [x] Chart front-end
- [x] Backend controllers
- [x] Unique URL per generated quote
- [x] Monthly bill chart/computations
- [x] ROI graph
- [x] Greenhouse emission graph
- [ ] ~~Save charts/data to PDF~~
- [x] Share charts/data to social networks
- [ ] ~~Add computations for Windmill conversion~~
- [x] Varying solar insolation (6 months sunny, 6 months cloudy/rain)
- [x] Tidy code for code review
- [ ] ~~Upload to live server~~

Made with PHP/CI & HTML5, CSS, and JS.

Charts are generated using framework [Chart.js](http://chartjs.org)

All computations are based on prices found on websites of the three major solar retailers in the Philippines (Solaric, Solar Systems Philippines, and Solar Star). Calculations are optimum solar output per 250W solar panel. Meralco rates for calculating user's average monthly electricity bill are based on rates from Meralco as of May, 2014.

Calculations for monthly bill of user is based on average Philippine solar insolation per month. Solar insolation varies per month, from as much as +7% during summer and -6% during typhoon season. Cloudy/typhoon months are taken into account in calculations.

======
###License

Standard MIT License
