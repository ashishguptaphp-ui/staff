
    setTimeout(() => {
      document.getElementById("main-content").style.display = "block";
    }, 2000);

  const ctx = document.getElementById('genderChart').getContext('2d');
  
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Male', 'Female', 'Others'],
      datasets: [
        {
          label: 'Teaching',
          data: [348177, 385166, 3],
          backgroundColor: 'rgba(54, 162, 235, 0.7)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1
        },
        {
          label: 'Non-Teaching',
          data: [75667, 28636, 7],
          backgroundColor: 'rgba(255, 99, 132, 0.7)',
          borderColor: 'rgba(255, 99, 132, 1)',
          borderWidth: 1
        }
      ]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'top',
        },
        tooltip: {
          mode: 'index',
          intersect: false,
        }
      },
      interaction: {
        mode: 'nearest',
        axis: 'x',
        intersect: false
      },
      scales: {
        y: {
          beginAtZero: true
        }
      },
      animation: {
        duration: 2000,
        easing: 'easeOutBounce'
      }
    }
  });


    const labels = ["Post Doctoral", "PhD", "M.Phil.", "Post-Graduate", "Graduate", "Higher Secondary", "Secondary", "Below Secondary"];

    // Teaching data
    const teachingData = [169, 2821, 2230, 282996, 342374, 73145, 28033, 1578];

    // Non-Teaching data
    const nonTeachingData = [24, 25, 58, 7902, 27422, 23581, 25654, 19644];

    const colors = [
      "#ff6384", "#36a2eb", "#ffce56", "#4bc0c0", "#9966ff", "#ff9f40", "#66ff66", "#c9cbcf"
    ];

    // Teaching Pie
    new Chart(document.getElementById('teachingPie'), {
      type: 'pie',
      data: {
        labels: labels,
        datasets: [{
          label: 'Teaching Staff',
          data: teachingData,
          backgroundColor: colors,
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        plugins: {
          title: {
            display: true,
            text: 'Teaching Staff by Qualification'
          },
          tooltip: {
            callbacks: {
              label: function(context) {
                let label = context.label || '';
                let value = context.parsed;
                return `${label}: ${value.toLocaleString()}`;
              }
            }
          }
        }
      }
    });

    // Non-Teaching Pie
    new Chart(document.getElementById('nonTeachingPie'), {
      type: 'pie',
      data: {
        labels: labels,
        datasets: [{
          label: 'Non-Teaching Staff',
          data: nonTeachingData,
          backgroundColor: colors,
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        plugins: {
          title: {
            display: true,
            text: 'Non-Teaching Staff by Qualification'
          },
          tooltip: {
            callbacks: {
              label: function(context) {
                let label = context.label || '';
                let value = context.parsed;
                return `${label}: ${value.toLocaleString()}`;
              }
            }
          }
        }
      }
    });
  

  
    const socialLinelabels = ["General", "SC", "ST", "OBC","VJA","NT-B","NT-C","NT-D","SBC"];
    
    const socialLineteachingData = [362178, 77429, 45189, 194463, 10948, 10212, 15199, 9651, 8077];
    const socialLinenonTeachingData = [44437, 15861, 6989, 23997, 2893, 3047, 3558, 1822, 1706];
	
    new Chart(document.getElementById('socialLine'), {
      type: 'line',
      data: {
        labels: socialLinelabels,
        datasets: [
          {
            label: "Teaching Staff",
            data: socialLineteachingData,
            borderColor: "#36a2eb",
            backgroundColor: "rgba(54,162,235,0.2)",
            borderWidth: 3,
            pointBackgroundColor: "#36a2eb",
            fill: true,
            tension: 0.3
          },
          {
            label: "Non-Teaching Staff",
            data: socialLinenonTeachingData,
            borderColor: "#ff6384",
            backgroundColor: "rgba(255,99,132,0.2)",
            borderWidth: 3,
            pointBackgroundColor: "#ff6384",
            fill: true,
            tension: 0.3
          } 
        ]
      },
      options: {
        responsive: true,
        plugins: {
          title: {
            display: true,
            text: 'Teaching vs Non-Teaching Staff by Social Category',
            font: { size: 16 }
          },
          tooltip: {
            callbacks: {
              label: function(context) {
                let value = context.parsed.y;
                return `${context.dataset.label}: ${value.toLocaleString()}`;
              }
            }
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            title: { display: true, text: "Number of Staff" }
          },
          x: {
            title: { display: true, text: "Social Categories" }
          }
        }
      }
    });
  




    const disabilityRadarlabels = ["Hearing Impaired", "Loco motor", "Not applicable", "Visual", "Others"];

    const disabilityRadarteaching = [1106, 8354, 875732, 2357, 9038];
    const disabilityRadarnonTeaching = [154, 625, 106101, 169, 1636];

    new Chart(document.getElementById('disabilityRadar'), {
      type: 'radar',
      data: {
        labels: disabilityRadarlabels,
        datasets: [
          {
            label: "Teaching Staff",
            data: disabilityRadarteaching,
            backgroundColor: "rgba(54,162,235,0.2)",
            borderColor: "#36a2eb",
            pointBackgroundColor: "#36a2eb",
            borderWidth: 2
          },
          {
            label: "Non-Teaching Staff",
            data: disabilityRadarnonTeaching,
            backgroundColor: "rgba(255,99,132,0.2)",
            borderColor: "#ff6384",
            pointBackgroundColor: "#ff6384",
            borderWidth: 2
          }
        ]
      },
      options: {
        responsive: true,
        elements: {
          line: { tension: 0.2 }
        },
        plugins: {
          title: {
            display: true,
            text: 'Disability Categories Comparison',
            font: { size: 16 }
          },
          tooltip: {
            callbacks: {
              label: function(context) {
                let value = context.parsed.r;
                return `${context.dataset.label}: ${value.toLocaleString()}`;
              }
            }
          }
        },
        scales: {
          r: {
            beginAtZero: true,
            ticks: {
              callback: function(value) {
                return value.toLocaleString();
              }
            }
          }
        }
      }
    });
  


    const ctxdoughnut = document.getElementById('multiRingChart').getContext('2d');

    new Chart(ctxdoughnut, {
      type: 'doughnut',
      data: {
        labels: ["Hearing Impaired", "Loco motor", "Not applicable", "Visual", "Others"],
        datasets: [
          {
            label: 'Teaching',
            data: [979, 7322, 716095, 2036, 6914],
            backgroundColor: ['#3b82f6','#10b981','#f59e0b','#ef4444','#8b5cf6'],
            hoverOffset: 6
          },
          {
            label: 'Non-Teaching',
            data: [149, 599, 101816, 163, 1583],
            backgroundColor: ['#60a5fa','#34d399','#fbbf24','#f87171','#a78bfa'],
            hoverOffset: 6
          }
        ]
      },
      options: {
        responsive: true,
        cutout: '40%',
        plugins: {
          legend: {
            position: 'right',
            labels: {
              usePointStyle: true,
              pointStyle: 'circle'
            }
          },
          tooltip: {
            callbacks: {
              label: function(context) {
                let label = context.dataset.label || '';
                let value = context.raw;
                return `${label} - ${context.label}: ${value}`;
              }
            }
          }
        }
      }
    });





  const ctxAppointType = document.getElementById('chartStaffType').getContext('2d');

  // X-axis categories
  const chartStaffTypes = ["Regular", "Contract", "Part-Time/Guest"];

  // Teaching & Non-Teaching values
  const chartStaffTypeteachingCounts = [657602, 71524, 4220];
  const chartStaffTypenonTeachingCounts = [95830, 8222, 258];
  const chartStaffTypedata = {
    labels: chartStaffTypes,
    datasets: [
      {
        label: 'Teaching',
        data: chartStaffTypeteachingCounts,
        borderColor: '#36a2eb',
        backgroundColor: '#36a2eb33',
        fill: true,
        tension: 0.3,   // smooth line
        pointRadius: 5,
        pointHoverRadius: 7
      },
      {
        label: 'Non-Teaching',
        data: chartStaffTypenonTeachingCounts,
        borderColor: '#ff6384',
        backgroundColor: '#ff638433',
        fill: true,
        tension: 0.3,
        pointRadius: 5,
        pointHoverRadius: 7
      }
    ]
  };

  const config = {
    type: 'line',
    data: chartStaffTypedata,
    options: {
      responsive: true,
      plugins: {
         title: {
          display: true,
          text: 'Teaching & Non-Teaching by Appointment Type',
          font: {
            size: 18,
            weight: 'bold'
          },
          padding: { top: 10, bottom: 20 }
        },
        legend: { position: 'top' },
        tooltip: {
          callbacks: {
            label: function(context) {
              return context.dataset.label + ": " + context.raw.toLocaleString();
            }
          }
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          title: {
            display: true,
            text: "Number of Staff"
          }
        },
        x: {
          title: {
            display: true,
            text: "Appointment Type"
          }
        }
      }
    }
  };

  const myChart = new Chart(ctxAppointType, config);

<style>
    body { font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial; background:#f6f8fb; color:#1f2937; padding:28px; }
    .card { background:white; border-radius:12px; box-shadow:0 6px 18px rgba(22, 28, 37, 0.06); padding:18px; max-width:980px; margin:0 auto; }
    h2 { margin:0 0 12px 0; font-size:20px; }
    #staffChart { flex:1 1 0; height:420px; }
    .controls { width:260px; }
    .btn { display:inline-block; padding:8px 12px; border-radius:8px; border:0; cursor:pointer; background:#2563eb; color:white; margin-top:8px; }
    small { color:#6b7280; display:block; margin-top:6px; }
    .legend-dot { display:inline-block; width:10px; height:10px; border-radius:50%; margin-right:8px; vertical-align:-1px; }
  </style>
  
    // Data (from your input / merged summary)
    const categories = ["Primary", "Upper Primary", "Secondary", "Higher Secondary"];
    const teaching = [135973, 196002, 184583, 216788];
    const nonTeaching = [5426, 9750, 48522, 40612];
    const totals = teaching.map((t,i) => t + nonTeaching[i]);

    // Create chart
    const ctxstaffChart = document.getElementById('classChart').getContext('2d');

    // Create nice gradients
    const gradTeach = ctxstaffChart.createLinearGradient(0, 0, 0, 420);
    gradTeach.addColorStop(0, 'rgba(37,99,235,0.95)');
    gradTeach.addColorStop(1, 'rgba(59,130,246,0.65)');

    const gradNon = ctxstaffChart.createLinearGradient(0, 0, 0, 420);
    gradNon.addColorStop(0, 'rgba(16,185,129,0.95)');
    gradNon.addColorStop(1, 'rgba(20,184,166,0.6)');

    const gradLine = ctxstaffChart.createLinearGradient(0, 0, 420, 0);
    gradLine.addColorStop(0, 'rgba(245,158,11,0.95)');
    gradLine.addColorStop(1, 'rgba(250,204,21,0.95)');

    // Build chart config
    const configstaffChart = {
        type: 'bar',
        data: {
            labels: categories,
            datasets: [
            {
                type: 'bar',
                label: 'Teaching',
                data: teaching,
                borderRadius: 6,
                borderSkipped: false,
                backgroundColor: gradTeach,
                maxBarThickness: 60,
                hoverOffset: 6,
            },
            {
                type: 'bar',
                label: 'Non-Teaching',
                data: nonTeaching,
                borderRadius: 6,
                borderSkipped: false,
                backgroundColor: gradNon,
                maxBarThickness: 60,
                hoverOffset: 6,
            },
            {
                type: 'line',
                label: 'Total',
                data: totals,
                yAxisID: 'y',
                tension: 0.35,
                pointRadius: 6,
                pointHoverRadius: 10,
                borderColor: gradLine,
                borderWidth: 3,
                fill: false,
                order: 2,
                pointStyle: 'rectRounded'
            }
            ]
        
      },

    options: {
    responsive: true,
    maintainAspectRatio: false,
    interaction: { mode: 'index', intersect: false },
    plugins: {
      legend: {
        position: 'top',
        labels: { usePointStyle: true, pointStyle: 'rectRounded' }
      },
      tooltip: {
        enabled: false, // still using external tooltip
        external: externalTooltipHandler
      },
      subtitle: {
        display: true,
        text: 'Teaching (blue) & Non-Teaching (green) side-by-side, Total (amber) line'
      }
    },
    scales: {
      x: {
        stacked: false,      // ✅ key change
        grid: { display: false }
      },
      y: {
        stacked: false,      // ✅ key change
        beginAtZero: true,
        ticks: {
          callback: value => value >= 1000 ? (value/1000) + 'k' : value
        }
      }
    },
    animation: {
      duration: 900,
      easing: 'cubicBezier(.2,.8,.2,1)'
    },
    onHover: (event, chartElement) => {
      if (event.native) {
        event.native.target.style.cursor = chartElement.length ? 'pointer' : 'default';
      }
    }
  },
};
    const staffChart = new Chart(ctxstaffChart, configstaffChart);

    // set legend dot colors to match gradients (approx)
    document.getElementById('dot-teaching').style.background = 'linear-gradient(180deg, rgba(37,99,235,0.95), rgba(59,130,246,0.65))';
    document.getElementById('dot-nonteaching').style.background = 'linear-gradient(180deg, rgba(16,185,129,0.95), rgba(20,184,166,0.6))';
    document.getElementById('dot-total').style.background = 'linear-gradient(90deg, rgba(245,158,11,0.95), rgba(250,204,21,0.95))';

    // External tooltip to show breakdown and emojis
    function externalTooltipHandler(context) {
      // Tooltip Element
      const {chart, tooltip} = context;
      let tooltipEl = chart.canvas.parentNode.querySelector('div.chartjs-tooltip');

      // Create element on first render
      if (!tooltipEl) {
        tooltipEl = document.createElement('div');
        tooltipEl.classList.add('chartjs-tooltip');
        tooltipEl.style.background = 'rgba(17,24,39,0.92)';
        tooltipEl.style.color = 'white';
        tooltipEl.style.borderRadius = '8px';
        tooltipEl.style.padding = '10px 12px';
        tooltipEl.style.pointerEvents = 'none';
        tooltipEl.style.position = 'absolute';
        tooltipEl.style.transform = 'translate(-50%, -120%)';
        tooltipEl.style.whiteSpace = 'nowrap';
        tooltipEl.style.fontSize = '13px';
        tooltipEl.style.boxShadow = '0 6px 18px rgba(2,6,23,0.4)';
        chart.canvas.parentNode.appendChild(tooltipEl);
      }

      // Hide if no tooltip
      if (tooltip.opacity === 0) {
        tooltipEl.style.opacity = 0;
        return;
      }

      // Set text
      const idx = tooltip.dataPoints ? tooltip.dataPoints[0].dataIndex : 0;
      const label = chart.data.labels[idx];
      const teachVal = teaching[idx];
      const nonVal = nonTeaching[idx];
      const tot = totals[idx];

      tooltipEl.innerHTML = `
        <div style="font-weight:600; margin-bottom:6px;">${label}</div>
        <div style="display:flex; gap:8px; align-items:center;">
          <div style="min-width:10px; height:10px; background:rgba(37,99,235,0.95); border-radius:3px;"></div>
          <div>🧑‍🏫 Teaching: <strong>${numberWithCommas(teachVal)}</strong></div>
        </div>
        <div style="display:flex; gap:8px; align-items:center; margin-top:6px;">
          <div style="min-width:10px; height:10px; background:rgba(16,185,129,0.95); border-radius:3px;"></div>
          <div>👥 Non-Teaching: <strong>${numberWithCommas(nonVal)}</strong></div>
        </div>
        <div style="display:flex; gap:8px; align-items:center; margin-top:8px; border-top:1px solid rgba(255,255,255,0.06); padding-top:8px;">
          <div style="min-width:10px; height:10px; background:linear-gradient(90deg, rgba(245,158,11,0.95), rgba(250,204,21,0.95)); border-radius:3px;"></div>
          <div>📈 Total: <strong>${numberWithCommas(tot)}</strong></div>
        </div>
      `;

      // Position tooltip
      const canvasRect = chart.canvas.getBoundingClientRect();
      const pt = chart.getDatasetMeta(0).data[idx].getCenterPoint ? chart.getDatasetMeta(0).data[idx].getCenterPoint() : { x: tooltip.caretX, y: tooltip.caretY };
      tooltipEl.style.left = (pt.x + canvasRect.left) + 'px';
      tooltipEl.style.top = (pt.y + canvasRect.top) + 'px';
      tooltipEl.style.opacity = 1;
    }

    // small helper
    function numberWithCommas(x) {
      return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    // Download button
    document.getElementById('downloadBtn').addEventListener('click', () => {
      const link = document.createElement('a');
      link.href = staffChart.toBase64Image('image/png', 1);
      link.download = 'staff_chart.png';
      link.click();
    });

  



  const classTaughtctx = document.getElementById('classChart1').getContext('2d');

  const classTaughtlabels = [
    "Primary only",
    "Upper primary only",
    "Primary and Upper primary",
    "Secondary only",
    "Higher Secondary only",
    "Upper primary and Secondary",
    "Secondary and Higher secondary",
    "Pre-Primary only",
    "Pre-Primary & Primary",
    "Other"
  ];

  
  const classTaughtTechingdata = [364808,125068,90385,146553,80556,61125,12049,9519,6021,503];

  const classTaughtcolors = [
    "#2563eb","#16a34a","#f59e0b","#ef4444","#8b5cf6",
    "#06b6d4","#84cc16","#f43f5e","#0ea5e9","#64748b"
  ];

  const classTaughtgradient = classTaughtctx.createLinearGradient(0, 0, 0, 400);
  classTaughtgradient.addColorStop(0, '#2563eb');
  classTaughtgradient.addColorStop(1, '#16a34a');

  new Chart(classTaughtctx, {
    type: 'bar',
    data: {
      labels: classTaughtlabels,
      datasets: [{
        label: 'Teacher Count',
        data: classTaughtdata,
        backgroundColor: classTaughtcolors,
        borderRadius: 6
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false },
        tooltip: {
          callbacks: {
            label: function(context) {
              return context.formattedValue.replace(/\B(?=(\d{3})+(?!\d))/g, ",") + " teachers";
            }
          }
        }
      },
      scales: {
        x: { ticks: { font: { size: 12 }, maxRotation: 45, minRotation: 45 } },
        y: {
          beginAtZero: true,
          ticks: { callback: value => value.toLocaleString() }
        }
      }
    }
  });


  

/* Data provided */
const appointedlevelsChartlabels = [
  "PRT / Primary Teacher",
  "TGT / Trained Graduate Teacher",
  "PGT / Post Graduate Teacher",
  "Asst. Head Master / Vice Principal",
  "NTT / Pre-Primary Teacher",
  "Other"
];

const appointedlevelsChartcounts = [364808, 125068, 90385, 80556, 61125, 174645];

/* compute total */
const appointedlevelsCharttotal = appointedlevelsChartcounts.reduce((a,b)=>a+b,0);

/* update summary totals with formatted numbers */
function fmt(n){ return n.toLocaleString(); }


/* Create subtle professional gradients for each bar */
function makeGradient(appointedlevelsChartctx, colorFrom, colorTo){
  const g = appointedlevelsChartctx.createLinearGradient(0,0,800,0);
  g.addColorStop(0, colorFrom);
  g.addColorStop(1, colorTo);
  return g;
}

const appointedlevelsChartctx = document.getElementById('appointedlevelsChart').getContext('2d');

/* build dataset with individual gradients */
const appointedlevelsChartgradientColors = [
  makeGradient(appointedlevelsChartctx, '#e6f0ff', '#2d6cdf'),
  makeGradient(appointedlevelsChartctx, '#eafbf0', '#16a34a'),
  makeGradient(appointedlevelsChartctx, '#fff8e6', '#d97706'),
  makeGradient(appointedlevelsChartctx, '#fff8f8', '#ef4444'),
  makeGradient(appointedlevelsChartctx, '#f0fdfa', '#059669'),
  makeGradient(appointedlevelsChartctx, '#f3f4f6', '#475569')
];

const appointedlevelsChartdata = {
  labels: appointedlevelsChartlabels,
  datasets: [{
    label: 'Teacher Count',
    data: appointedlevelsChartcounts,
    backgroundColor: appointedlevelsChartgradientColors,
    borderColor: 'rgba(255,255,255,0.6)',
    borderWidth: 1,
    hoverOffset: 6,
    borderRadius: 8,
    barThickness: 28
  }]
};

/* Chart options: horizontal bars */
const appointedlevelsChartconfig = {
  type: 'bar',
  data: appointedlevelsChartdata,
  options: {
    indexAxis: 'y', // horizontal bars
    responsive: true,
    maintainAspectRatio: false,
    animation: { duration: 1400, easing: 'easeOutCubic' },
    plugins: {
      legend: { display: true },
      tooltip: {
        callbacks: {
          label: function(ctx){
            const v = appointedlevelsChartctx.raw;
            const pct = (v / appointedlevelsCharttotal * 100);
            return `${fmt(v)} (${pct.toFixed(2)}%)`;
          }
        }
      }
    },
    scales: {
      x: {
        beginAtZero: true,
        ticks: {
          callback: v => v.toLocaleString()
        },
        grid: { color: '#eef2ff' }
      },
      y: {
        grid: { display: false },
        ticks: { font: { size: 13 } }
      }
    },
  }
};

const chart = new Chart(appointedlevelsChartctx, appointedlevelsChartconfig);


 
    const radarLanguageChartctx = document.getElementById('radarLanguageChart').getContext('2d');
    const radarChart = new Chart(radarLanguageChartctx, {
      type: 'radar',
      data: {
        labels: [
          "Bengali","English","Gujarati","Hindi","Kannada","Malayalam","Marathi","Odia","Other","Rajasthani","Sanskrit","Sindhi","Tamil","Telugu","Urdu"
        ],
        datasets: [
          {
            label: 'Language 1',
            data: [303,211033,1127,44474,1781,0,439014,0,350,0,0,157,244,319,34544],
            borderColor: 'rgba(30,144,255,0.8)',
            backgroundColor: 'rgba(30,144,255,0.3)',
            pointBackgroundColor: 'rgba(30,144,255,1)',
            fill: true
          },
          {
            label: 'Language 2',
            data: [217,101608,802,467015,554,1,104770,0,53250,0,1,193,355,229,4351],
            borderColor: 'rgba(40,167,69,0.8)',
            backgroundColor: 'rgba(40,167,69,0.3)',
            pointBackgroundColor: 'rgba(40,167,69,1)',
            fill: true
          },
          {
            label: 'Language 3',
            data: [918,378216,1468,123416,704,0,118650,1,104618,1,5,657,801,599,3292],
            borderColor: 'rgba(255,87,51,0.8)',
            backgroundColor: 'rgba(255,87,51,0.3)',
            pointBackgroundColor: 'rgba(255,87,51,1)',
            fill: true
          }
        ]
      },
      options: {
        responsive: true,
        plugins: {
          title: {
            display: true,
            text: 'Comparison of Medium wise Languages',
            font: { size: 18 }
          },
          tooltip: { enabled: true }
        },
        scales: {
          r: {
            angleLines: { display: true },
            suggestedMin: 0,
            ticks: { stepSize: 50000 },
            pointLabels: {
              font: { size: 12 }
            }
          }
        },
        animation: {
          duration: 2000,
          easing: 'easeOutElastic'
        }
      }
    });
  

  

function createPieChart(id, labels, data) {
  new Chart(document.getElementById(id), {
    type: 'pie',
    data: {
      labels: labels,
      datasets: [{
        data: data,
        backgroundColor: ['#4caf50', '#f44336', '#9e9e9e'],
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { position: 'bottom' }
      }
    }
  });
}

// 1. Deputation
createPieChart("chart1", ["Yes", "No", "NA"], [6519, 726571, 256]);

// 2. Guest / Contractual
//createPieChart("chart2", ["Yes", "No", "NA"], [15237, 717853, 256]);

// 3. CWSN Training
createPieChart("chart3", ["Yes", "No", "NA"], [75943, 657053, 350]);
// 4. Computer Training
createPieChart("chart4", ["Yes", "No", "NA"], [533736, 199260, 350]);

// 5. NISHTHA Training
createPieChart("chart5", ["Yes", "No", "NA"], [313115, 419662, 569]);

  <!-- Animated counter -->
  
    function animateCount(id, endValue, duration=1500) {
      const el = document.getElementById(id);
      let startTime=null;
      function step(ts){
        if(!startTime) startTime=ts;
        const progress=Math.min((ts-startTime)/duration,1);
        const value=Math.floor(endValue*progress);
        el.textContent=value.toLocaleString();
        if(progress<1) requestAnimationFrame(step);
      }
      requestAnimationFrame(step);
    }

    document.addEventListener('DOMContentLoaded',()=>{
      animateCount('countTotal',837656,1200);
      animateCount('countTeaching',733346,1500);
      animateCount('countNonTeaching',104310,1600);
    });
  
  
  <!-- Counter Animation -->
  
    function animateCount(id, endValue, duration=1500) {
      const el=document.getElementById(id);
      let start=null;
      function step(ts){
        if(!start) start=ts;
        const progress=Math.min((ts-start)/duration,1);
        el.textContent=Math.floor(endValue*progress).toLocaleString();
        if(progress<1) requestAnimationFrame(step);
      }
      requestAnimationFrame(step);
    }

    document.addEventListener('DOMContentLoaded',()=>{
      animateCount('countTotalSchools',108920,1600);
      animateCount('countTotalSchools1',108920,1600);
      animateCount('c1',49488,1400);
      animateCount('c2',29158,1400);
      animateCount('c3',11301,1400);
      animateCount('c4',7847,1400);
      animateCount('c5',5980,1400);
      animateCount('c6',2611,1400);
      animateCount('c7',1298,1400);
      animateCount('c8',956,1400);
      animateCount('c9',187,1400);
      animateCount('c10',94,1400);
    });
  

