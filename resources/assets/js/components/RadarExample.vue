<script>
import { Radar, mixins } from 'vue-chartjs'
const { reactiveProp } = mixins;

export default {
  extends: Radar,
  mixins: [reactiveProp],
  props:{
            // datos1:{type: Array},
            // datos2:{type: Array}
            },
   data () {
      return {
      /* datacollection: {
          labels: [['Social','Networks'], 'Personal Care', 'Empowerment', 'NPS', 'Impulsivity', 'Smoking', 'Safe Housing','Physical Health','Mental Health','Drug & Alcohol use' ],
          datasets: [
            {
              label: '01/01/2018',
               lineTension: 0.1,
              backgroundColor: 'rgba(179,181,198,0.2)',
              borderColor: 'rgba(179,181,198,1)',
              pointBackgroundColor: 'rgba(179,181,198,1)',
              pointBorderColor: '#fff',
              pointRadius: 4,
              pointHoverBackgroundColor: '#fff',
              pointHoverBorderColor: 'rgba(179,181,198,1)',
              data: this.datos1
            },
            {
              label: '01/02/2018',
               lineTension: 0.1,
              backgroundColor: 'rgba(255,99,132,0.2)',
              borderColor: 'rgba(255,99,132,1)',
              pointBackgroundColor: 'rgba(255,99,132,1)',
              pointBorderColor: '#fff',
              pointRadius: 4,
              pointHoverBackgroundColor: '#fff',
              pointHoverBorderColor: 'rgba(255,99,132,1)',
              data: this.datos2
             
            }
          ],
      }, */
      options: {
              responsive: true,
              maintainAspectRatio: true,
             scale: {
/*               gridLines: {
                color: "black",
                lineWidth: 1
              }, */
              pointLabels: {
                 fontSize: 15,
                fontStyle: '300',
                fontColor: 'rgba(204, 204, 204, 1)',
                fontFamily: "'Lato', sans-serif"
              },

              
              ticks: {
                beginAtZero: true,
                min: 0,
                max: 10,
                stepSize: 1
              }
             }
            }
    }
},
  mounted () {
    // setInterval(() => {
      // this.datacollection.datasets[0].data=this.datos1;
      // this.datacollection.datasets[1].data=this.datos2;
      this.renderChart(this.chartData, this.options)
    // },  5000)
    
  }
}
</script>
