// Original functions
function openDemo(demoId) {
  // Track demo clicks for heatmap
  if (window.heatmapInstance) {
    window.heatmapInstance.addData({
      x: event.clientX,
      y: event.clientY,
      value: 1
    });
  }
  
  console.log(`Opening demo: ${demoId}`);
  // window.open('https://your-demo-url.com', '_blank');
}

function handleInterest(isInterested) {
  const slug = window.location.pathname.split("/").pop(); // Get the slug from URL
  const interestedValue = isInterested ? 'Interested' : 'Not Interested';
  
  // Get the CTA section to update
  const ctaSection = document.querySelector('.cta-section');
  const ctaButtons = document.querySelector('.cta-buttons');
  
  // Disable buttons immediately to prevent spam clicking
  const buttons = ctaButtons.querySelectorAll('button');
  buttons.forEach(btn => {
    btn.disabled = true;
    btn.style.opacity = '0.6';
    btn.style.cursor = 'not-allowed';
  });
  
  // Show loading state
  ctaButtons.innerHTML = `
    <div style="text-align: center; padding: 20px;">
      <div style="display: inline-block; width: 20px; height: 20px; border: 2px solid #ccc; border-radius: 50%; border-top-color: #007bff; animation: spin 1s linear infinite;"></div>
      <p style="margin-top: 10px; color: #666;">Processing your response...</p>
    </div>
  `;
  
  // Add CSS for spinner animation if not already present
  if (!document.getElementById('spinner-style')) {
    const style = document.createElement('style');
    style.id = 'spinner-style';
    style.textContent = `
      @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
      }
    `;
    document.head.appendChild(style);
  }

  fetch('api/update-response.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: new URLSearchParams({
      slug: slug,
      interested: interestedValue
    })
  })
  .then(response => {
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    return response.json();
  })
  .then(data => {
    if (data.success) {
      // Show success message
      showResponseMessage(isInterested, data.message);
      
      // Store response in localStorage to persist across page reloads
      localStorage.setItem(`response_${slug}`, interestedValue);
      localStorage.setItem(`response_time_${slug}`, Date.now().toString());
      
    } else {
      throw new Error(data.message || 'Unknown error occurred');
    }
  })
  .catch(error => {
    console.error('Error:', error);
    
    // Show error message and restore buttons
    ctaButtons.innerHTML = `
      <div style="text-align: center; padding: 20px; color: #dc3545;">
        <p>⚠️ Something went wrong. Please try again.</p>
        <button class="btn btn-primary" onclick="handleInterest(true)" style="margin-right: 10px;">
          Yes, Let's Talk!
        </button>
        <button class="btn btn-secondary" onclick="handleInterest(false)">
          I Need More Time
        </button>
      </div>
    `;
  });
}

function showResponseMessage(isInterested, customMessage = null) {
  const ctaSection = document.querySelector('.cta-section');
  const ctaButtons = document.querySelector('.cta-buttons');
  
  const thankYouMessage = customMessage || (isInterested 
    ? "Thank you for your interest! We'll be in touch soon to discuss your project."
    : "Thank you for your response. Feel free to reach out when you're ready!"
  );
  
  const iconClass = isInterested ? '🎉' : '👍';
  const colorClass = isInterested ? '#28a745' : '#6c757d';
  
  ctaButtons.innerHTML = `
    <div style="text-align: center; padding: 30px; background: #f8f9fa; border-radius: 10px; border: 2px solid ${colorClass};">
      <div style="font-size: 3em; margin-bottom: 15px;">${iconClass}</div>
      <h3 style="color: ${colorClass}; margin-bottom: 15px;">Response Received!</h3>  
      <p style="font-size: 1.1em; color: #333; line-height: 1.5;">${thankYouMessage}</p>
      ${isInterested ? `
        <div style="margin-top: 20px; padding: 15px; background: #d4edda; border-radius: 5px; color: #155724;">
          <strong>What's Next?</strong><br>
          We'll review your project details and get back to you within 24 hours with next steps.
        </div>
      ` : ''}
    </div>
  `;
}

function checkExistingResponse() {
  const slug = window.location.pathname.split("/").pop();
  const existingResponse = localStorage.getItem(`response_${slug}`);
  const responseTime = localStorage.getItem(`response_time_${slug}`);
  
  if (existingResponse && responseTime) {
    const timeDiff = Date.now() - parseInt(responseTime);
    const hoursSince = timeDiff / (1000 * 60 * 60);
    
    // Show thank you message if response was within last 24 hours
    if (hoursSince < 24) {
      const isInterested = existingResponse === 'Interested';
      showResponseMessage(isInterested);
      return true;
    } else {
      // Clear old response if it's more than 24 hours old
      localStorage.removeItem(`response_${slug}`);
      localStorage.removeItem(`response_time_${slug}`);
    }
  }
  
  return false;
}

// Check for existing response when page loads
document.addEventListener('DOMContentLoaded', () => {
  checkExistingResponse();
});

class StatisticRotator {
    constructor() {
        this.statistics = document.querySelectorAll('.statistic-item');
        this.dots = document.querySelectorAll('.stat-dot');
        this.currentIndex = 0;
        this.interval = null;
        this.init();
    }

    init() {
        this.startRotation();
        
        const container = document.querySelector('.statistic-box');
        if (container) {
            container.addEventListener('mouseenter', () => this.pauseRotation());
            container.addEventListener('mouseleave', () => this.startRotation());
        }
    }

    showStatistic(index) {
        this.statistics.forEach((stat, i) => {
            stat.classList.toggle('active', i === index);
        });
        
        this.dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === index);
        });
        
        this.currentIndex = index;
    }

    nextStatistic() {
        const nextIndex = (this.currentIndex + 1) % this.statistics.length;
        this.showStatistic(nextIndex);
    }

    startRotation() {
        if (this.interval) return;
        
        this.interval = setInterval(() => {
            this.nextStatistic();
        }, 4000);
    }

    pauseRotation() {
        if (this.interval) {
            clearInterval(this.interval);
            this.interval = null;
        }
    }
}

// Heatmap Implementation
class HeatmapTracker {
    constructor() {
        this.heatmapContainer = null;
        this.heatmapInstance = null;
        this.isEnabled = false;
        this.adminMode = false;
        this.init();
    }

    init() {
        // Check if admin mode (you can set this via URL parameter or localStorage)
        this.adminMode = new URLSearchParams(window.location.search).has('heatmap') || 
                         localStorage.getItem('heatmap_admin') === 'true';
        
        if (this.adminMode) {
            this.loadHeatmapLibrary();
        } else {
            this.setupTracking();
        }
    }

    loadHeatmapLibrary() {
        // Load heatmap.js library
        const script = document.createElement('script');
        script.src = 'https://cdnjs.cloudflare.com/ajax/libs/heatmap.js/2.0.5/heatmap.min.js';
        script.onload = () => this.initializeHeatmap();
        document.head.appendChild(script);
    }

    initializeHeatmap() {
        // Create heatmap container
        this.heatmapContainer = document.createElement('div');
        this.heatmapContainer.id = 'heatmap-container';
        this.heatmapContainer.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1000;
        `;
        document.body.appendChild(this.heatmapContainer);

        // Initialize heatmap
        this.heatmapInstance = h337.create({
            container: this.heatmapContainer,
            maxOpacity: 0.6,
            radius: 50,
            blur: 0.75,
            gradient: {
                0.25: "rgb(0,0,255)",
                0.55: "rgb(0,255,0)",
                0.85: "yellow",
                1.0: "rgb(255,0,0)"
            }
        });

        window.heatmapInstance = this.heatmapInstance;
        this.isEnabled = true;
        this.loadStoredData();
        this.setupAdminControls();
    }

    setupTracking() {
        // Track mouse movements and clicks without visualization
        let mouseData = [];
        
        document.addEventListener('mousemove', (e) => {
            mouseData.push({
                x: e.clientX,
                y: e.clientY,
                timestamp: Date.now()
            });
        });

        document.addEventListener('click', (e) => {
            const clickData = {
                x: e.clientX,
                y: e.clientY,
                value: 1,
                timestamp: Date.now(),
                element: e.target.tagName,
                className: e.target.className,
                id: e.target.id
            };
            
            this.storeClickData(clickData);
        });

        // Store mouse movement data periodically
        setInterval(() => {
            if (mouseData.length > 0) {
                this.storeMouseData(mouseData);
                mouseData = [];
            }
        }, 5000);
    }

    storeClickData(data) {
        const stored = JSON.parse(localStorage.getItem('heatmap_clicks') || '[]');
        stored.push(data);
        // Keep only last 1000 clicks
        if (stored.length > 1000) {
            stored.shift();
        }
        localStorage.setItem('heatmap_clicks', JSON.stringify(stored));
    }

    storeMouseData(data) {
        const stored = JSON.parse(localStorage.getItem('heatmap_mouse') || '[]');
        stored.push(...data);
        // Keep only last 5000 mouse positions
        if (stored.length > 5000) {
            stored.splice(0, stored.length - 5000);
        }
        localStorage.setItem('heatmap_mouse', JSON.stringify(stored));
    }

    loadStoredData() {
        if (!this.heatmapInstance) return;

        // Load click data
        const clicks = JSON.parse(localStorage.getItem('heatmap_clicks') || '[]');
        const mouseData = JSON.parse(localStorage.getItem('heatmap_mouse') || '[]');

        const heatmapData = [];

        // Add click data with higher values
        clicks.forEach(click => {
            heatmapData.push({
                x: click.x,
                y: click.y,
                value: 2
            });
        });

        // Add mouse movement data with lower values
        mouseData.forEach(mouse => {
            heatmapData.push({
                x: mouse.x,
                y: mouse.y,
                value: 0.5
            });
        });

        if (heatmapData.length > 0) {
            this.heatmapInstance.setData({
                max: 5,
                data: heatmapData
            });
        }
    }

    setupAdminControls() {
        const controls = document.createElement('div');
        controls.id = 'heatmap-controls';
        controls.style.cssText = `
            position: fixed;
            top: 10px;
            right: 10px;
            background: rgba(0,0,0,0.8);
            color: white;
            padding: 10px;
            border-radius: 5px;
            z-index: 1001;
            font-family: Arial, sans-serif;
            font-size: 12px;
        `;
        
        controls.innerHTML = `
            <div style="margin-bottom: 10px;">
                <strong>Heatmap Controls</strong>
            </div>
            <button id="toggle-heatmap" style="margin-right: 5px;">Toggle</button>
            <button id="clear-heatmap" style="margin-right: 5px;">Clear</button>
            <button id="export-heatmap">Export</button>
            <div style="margin-top: 10px;">
                <label>
                    <input type="checkbox" id="show-clicks" checked> Clicks
                </label>
                <label style="margin-left: 10px;">
                    <input type="checkbox" id="show-mouse"> Mouse
                </label>
            </div>
        `;
        
        document.body.appendChild(controls);

        // Add event listeners
        document.getElementById('toggle-heatmap').addEventListener('click', () => {
            this.heatmapContainer.style.display = 
                this.heatmapContainer.style.display === 'none' ? 'block' : 'none';
        });

        document.getElementById('clear-heatmap').addEventListener('click', () => {
            localStorage.removeItem('heatmap_clicks');
            localStorage.removeItem('heatmap_mouse');
            this.heatmapInstance.setData({max: 5, data: []});
        });

        document.getElementById('export-heatmap').addEventListener('click', () => {
            this.exportHeatmapData();
        });

        document.getElementById('show-clicks').addEventListener('change', (e) => {
            if (e.target.checked) {
                this.loadStoredData();
            } else {
                // Show only mouse data
                const mouseData = JSON.parse(localStorage.getItem('heatmap_mouse') || '[]');
                const data = mouseData.map(mouse => ({
                    x: mouse.x,
                    y: mouse.y,
                    value: 0.5
                }));
                this.heatmapInstance.setData({max: 5, data});
            }
        });

        document.getElementById('show-mouse').addEventListener('change', (e) => {
            this.loadStoredData(); // Reload all data based on current settings
        });
    }

    exportHeatmapData() {
        const clicks = JSON.parse(localStorage.getItem('heatmap_clicks') || '[]');
        const mouse = JSON.parse(localStorage.getItem('heatmap_mouse') || '[]');
        
        const exportData = {
            clicks: clicks,
            mouse: mouse,
            url: window.location.href,
            timestamp: new Date().toISOString(),
            userAgent: navigator.userAgent,
            viewport: {
                width: window.innerWidth,
                height: window.innerHeight
            }
        };

        const blob = new Blob([JSON.stringify(exportData, null, 2)], {
            type: 'application/json'
        });
        
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = `heatmap-data-${Date.now()}.json`;
        a.click();
        URL.revokeObjectURL(url);
    }

    // Method to manually add heatmap data points
    addDataPoint(x, y, value = 1) {
        if (this.heatmapInstance) {
            this.heatmapInstance.addData({x, y, value});
        }
        
        // Also store for persistence
        this.storeClickData({x, y, value, timestamp: Date.now()});
    }
}

// Initialize everything when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new StatisticRotator();
    new HeatmapTracker();
    
    // Add tracking to existing elements
    document.querySelectorAll('.demo-card').forEach((card, index) => {
        card.addEventListener('click', (e) => {
            if (window.heatmapTracker) {
                window.heatmapTracker.addDataPoint(e.clientX, e.clientY, 2);
            }
        });
    });
    
    // Track scroll behavior
    let scrollTimeout;
    window.addEventListener('scroll', () => {
        clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(() => {
            if (window.heatmapTracker) {
                const scrollPercent = window.scrollY / (document.body.scrollHeight - window.innerHeight);
                window.heatmapTracker.addDataPoint(
                    window.innerWidth / 2, 
                    window.innerHeight * scrollPercent, 
                    0.5
                );
            }
        }, 100);
    });
});