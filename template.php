<?php
// Debug version - add this to the top of your proposal page


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>
    Web Design Proposal - <?= htmlspecialchars($lead['client_name']) ?>
  </title>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/all.min.css">
</head>

<body>
  <div class="header">
    <div class="container">
      <h1 class="client-name">
        <?= htmlspecialchars($lead['client_name']) ?> <i class="fa-duotone fa-solid fa-heart-half fa-beat"
          style="color: #D2042D"></i>
      </h1>
      <p class="subtitle">Your Custom Web Design Proposal</p>
    </div>
  </div>

  <div class="container main-content">
    <div class="section">
      <h2>Transform Your Online Presence</h2>
      <p><strong>Here's exactly what you'll get:</strong></p>
      <ul>
        <li>
          <strong>A website that converts visitors into customers</strong> – Custom-designed to reflect your unique
          brand and speak directly to your target audience
        </li>
        <li>
          <strong>Perfect on every device</strong> – Your site will look stunning and function flawlessly whether viewed
          on mobile, tablet, or desktop
        </li>
        <li><strong>Lightning-fast performance</strong> – Optimized for speed because every second counts for user
          experience and search rankings</li>
        <li>
          <strong>Built to be found</strong> – SEO best practices integrated from day one to help potential customers
          discover you online
        </li>
        <li>
          <strong>Future-proof foundation</strong> – Clean, well-documented code that makes updates and maintenance
          simple and cost-effective
        </li>
        <li><strong>Peace of mind support</strong> – Full 30 days of post-launch support to ensure everything runs
          smoothly</li>
      </ul>

      <div class="statistic-box">
        <div class="statistic-container">
          <div class="statistic-item active">
            <p><em>Studies indicate that 81% of consumers research a business online before visiting, meaning businesses
                without websites automatically lose 4 out of 5 potential customers before they even have a chance to
                compete.</em></p>
          </div>
          <div class="statistic-item">
            <p><em>Research reveals that businesses without a website lose up to 70% of potential customers who search
                online before making purchasing decisions, with 97% of consumers using the internet to find local
                services.</em></p>
          </div>
          <div class="statistic-item">
            <p><em>Small businesses without an online presence miss out on an estimated $3.2 billion in annual revenue,
                as 88% of consumers research businesses online before visiting or making a purchase.</em></p>
          </div>
          <div class="statistic-item">
            <p><em>Companies without websites lose an average of 60% of potential customers to competitors, while
                businesses with professional websites see 2.8x more revenue growth than those without an online
                presence.</em></p>
          </div>
          <div class="statistic-item">
            <p><em>75% of consumers judge a business's credibility based on their website design, and businesses without
                a professional online presence lose an average of 40% of potential customers to competitors.</em></p>
          </div>
        </div>
        <div class="stat-indicator">
          <div class="stat-dot active"></div>
          <div class="stat-dot"></div>
          <div class="stat-dot"></div>
          <div class="stat-dot"></div>
          <div class="stat-dot"></div>
        </div>
      </div>
    </div>

    <div class="section">
      <h2>Quality Examples</h2>
      <p>Here's the caliber of work you can expect for your project:</p>
      <p><em>You may click on a box to view the live demonstration!</em></p>
      <div class="demos-grid">

        <div class="demo-card" onclick="window.open('<?= $lead['demo1_url'] ?>', '_blank')">
          <img src="images/<?= htmlspecialchars($lead['demo1_image']) ?>" alt="<?= $lead['demo1_type'] ?>"
            class="demo-image" />
          <h3><?= htmlspecialchars($lead['demo1_title']) ?></h3>
          <p>
            <?= htmlspecialchars($lead['demo1_desc']) ?>
          </p>
        </div>

        <div class="demo-card" onclick="window.open('<?= $lead['demo2_url'] ?>', '_blank')">
          <img src="images/<?= htmlspecialchars($lead['demo2_image']) ?>" alt="<?= $lead['demo2_type'] ?>"
            class="demo-image" />
          <h3><?= htmlspecialchars($lead['demo2_title']) ?></h3>
          <p>
            <?= htmlspecialchars($lead['demo2_desc']) ?>
          </p>
        </div>
        <div class="demo-card" onclick="window.open('<?= $lead['demo3_url'] ?>', '_blank')">
          <img src="images/<?= htmlspecialchars($lead['demo3_image']) ?>" alt="<?= $lead['demo3_type'] ?>"
            class="demo-image" />
          <h3><?= htmlspecialchars($lead['demo3_title']) ?></h3>
          <p>
            <?= htmlspecialchars($lead['demo3_desc']) ?>
          </p>
        </div>

      </div>
    </div>

    <div class="offer-section">
      <div class="offer-content">
        <h2>Investment & Value</h2>
        <p>
          <strong>Complete website solution:</strong> Strategy, design, development, launch, and ongoing support.
        </p>

        <div class="price-container">
          <div class="value-badge">Limited Time Offer</div>
          <div class="price">
            <span class="original-price">$<?= htmlspecialchars($lead['original_price']) ?></span>
            <span class="current-price"><span
                class="price-highlight">$<?= htmlspecialchars($lead['offer_price']) ?></span></span>
          </div>
        </div>

        <div class="hosting-info">
          <h3>Complete Package Includes:</h3>
          <div class="package-details">
            <div class="package-item">
              <strong>✓ Professional hosting: <span class="hosting-price">$35.00/year</span></strong>
              <div class="description">Fast, secure, and reliable hosting infrastructure</div>
            </div>
            <div class="package-item">
              <strong>✓ Perfect domain registration</strong>
              <div class="description">I'll help you secure the ideal domain name for your brand</div>
            </div>
            <div class="package-item">
              <strong>✓ SSL certificate and security</strong>
              <div class="description">Your site will be fully secure and trusted</div>
            </div>
            <div class="package-item">
              <strong>✓ Regular backups and monitoring</strong>
              <div class="description">Your website is protected and maintained</div>
            </div>
          </div>
        </div>

        <div class="offer-details">
          <p><strong>Special introductory pricing – limited availability</strong></p>
          <p>
            <strong>Why this exceptional value?</strong> I'm strategically building relationships with forward-thinking
            businesses like yours. This isn't about cutting corners – it's about creating win-win partnerships. You get
            professional web design at an accessible investment, and I get to work with quality clients who value great
            design.
          </p>
          <p><em>This rate reflects my current capacity and won't be available indefinitely.</em></p>
        </div>
      </div>
    </div>

    <!-- CTA Section -->
    <div class="cta-section">
      <h2>Ready to Get Started?</h2>
      <p>Let's discuss how we can bring your vision to life:</p>

      <div class="cta-buttons">
        <?php if ($hasResponded): ?>
          <!-- Show thank you message if already responded -->
          <?php
          $isInterested = ($responseStatus === 'Interested');
          $iconClass = $isInterested ? '🎉' : '👍';
          $colorClass = $isInterested ? '#28a745' : '#6c757d';
          $thankYouMessage = getThankYouMessage($responseStatus);
          ?>

          <div
            style="text-align: center; padding: 30px; background: #f8f9fa; border-radius: 10px; border: 2px solid <?php echo $colorClass; ?>;">
            <div style="font-size: 3em; margin-bottom: 15px;"><?php echo $iconClass; ?></div>
            <h3 style="color: <?php echo $colorClass; ?>; margin-bottom: 15px;">Response Received!</h3>
            <p style="font-size: 1.1em; color: #333; line-height: 1.5;"><?php echo htmlspecialchars($thankYouMessage); ?>
            </p>

            <?php if ($isInterested): ?>
              <div style="margin-top: 20px; padding: 15px; background: #d4edda; border-radius: 5px; color: #155724;">
                <strong>What's Next?</strong><br>
                We'll review your project details and get back to you via the original method of communication within 24
                hours with next steps.
              </div>
            <?php endif; ?>

            <?php if ($responseDate): ?>
              <div style="margin-top: 15px; font-size: 0.9em; color: #666;">
                Response received: <?php echo date('M j, Y \a\t g:i A', strtotime($responseDate)); ?>
              </div>
            <?php endif; ?>
          </div>

        <?php else: ?>
          <!-- Show buttons if not yet responded -->
          <button class="btn btn-primary" onclick="handleInterest(true)">
            Yes, Let's Talk!
          </button>
          <button class="btn btn-secondary" onclick="handleInterest(false)">
            I Need More Time
          </button>
        <?php endif; ?>
      </div>
    </div>

    <script>
      // Pass PHP variables to JavaScript
      window.leadData = {
        hasResponded: <?php echo json_encode($hasResponded); ?>,
        responseStatus: <?php echo json_encode($responseStatus); ?>,
        responseDate: <?php echo json_encode($responseDate); ?>,
        slug: <?php echo json_encode($slug); ?>
      };
    </script>
  </div>
  <script src="script.js"></script>
</body>

</html>