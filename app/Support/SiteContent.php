<?php

namespace App\Support;

class SiteContent
{
    /**
     * "Solutions" mega menu + /solutions/{slug} pages.
     */
    public static function solutions(): array
    {
        return [
            'digital-transformation' => [
                'group' => 'Business Solutions',
                'title' => 'Digital Transformation',
                'short' => 'Modernize how your business operates, end to end.',
                'icon' => 'transform',
                'hero' => 'Transform the Way Your Business Works',
                'subheadline' => 'We help organizations move from manual, disconnected processes to integrated digital operations that scale with growth.',
                'problem' => [
                    'Many growing businesses are held back by paper-based workflows, disconnected spreadsheets, and legacy systems that were never designed to talk to one another.',
                    'The result is slow decision-making, duplicated work, and a poor experience for both employees and customers.',
                ],
                'solution' => [
                    'NEXORA works with your leadership team to map current processes, identify friction points, and design a digital roadmap that is realistic for your organization\'s size and budget.',
                    'We then implement the systems, integrations, and training needed to make that roadmap a reality, without disrupting day-to-day operations.',
                ],
                'features' => [
                    'Digital maturity assessment and roadmap',
                    'Process automation for repetitive workflows',
                    'Data-driven decision-making dashboards',
                    'Integration between existing and new systems',
                    'Change management and staff training',
                ],
                'benefits' => [
                    'Faster, more consistent decision-making',
                    'Reduced operational cost over time',
                    'Better visibility across departments',
                    'A technology foundation that scales with growth',
                ],
                'related' => ['business-process-automation', 'enterprise-software', 'it-strategy-consulting'],
            ],
            'business-process-automation' => [
                'group' => 'Business Solutions',
                'title' => 'Business Process Automation',
                'short' => 'Remove repetitive manual work from your operations.',
                'icon' => 'automation',
                'hero' => 'Automate the Work That Slows Your Team Down',
                'subheadline' => 'We design and build automation for the repetitive, rule-based tasks that consume your team\'s time.',
                'problem' => [
                    'Approvals stuck in email threads, data re-entered across multiple systems, and reports assembled by hand each month all quietly drain productivity.',
                    'These tasks rarely feel urgent enough to fix on their own, so the cost accumulates unnoticed.',
                ],
                'solution' => [
                    'We identify high-friction, high-frequency processes and automate them using workflow engines, integrations, and custom tooling suited to your existing systems.',
                    'Automation is introduced gradually, with clear ownership and monitoring, so your team trusts the system from day one.',
                ],
                'features' => [
                    'Workflow mapping and automation opportunity assessment',
                    'Approval and notification automation',
                    'Automated data entry and synchronization between systems',
                    'Scheduled reporting and document generation',
                    'Monitoring dashboards for automated processes',
                ],
                'benefits' => [
                    'Hours returned to your team every week',
                    'Fewer manual errors in critical processes',
                    'Consistent, auditable workflows',
                    'Employees freed up for higher-value work',
                ],
                'related' => ['digital-transformation', 'system-integration', 'enterprise-software'],
            ],
            'enterprise-software' => [
                'group' => 'Business Solutions',
                'title' => 'Enterprise Software',
                'short' => 'Custom systems built around how your business actually works.',
                'icon' => 'software',
                'hero' => 'Software Built Around Your Business, Not the Other Way Around',
                'subheadline' => 'When off-the-shelf tools no longer fit, we design and build enterprise software tailored to your operations.',
                'problem' => [
                    'Generic software often forces businesses to change how they work to fit the tool, leading to workarounds and lost efficiency.',
                    'As a company grows, these limitations become more costly and harder to unwind.',
                ],
                'solution' => [
                    'Our team designs custom enterprise applications, internal tools, and platforms that reflect your real workflows, from inventory and operations to customer management.',
                    'We build with maintainability in mind, so the system can evolve as your business does.',
                ],
                'features' => [
                    'Custom internal business applications',
                    'Inventory, operations, and workflow management systems',
                    'Role-based access and approval structures',
                    'Reporting and analytics built into the system',
                    'Ongoing support and iterative development',
                ],
                'benefits' => [
                    'Software that matches your actual processes',
                    'Fewer manual workarounds and shadow spreadsheets',
                    'A system that grows alongside your business',
                    'Full ownership of your platform and data',
                ],
                'related' => ['digital-transformation', 'system-integration', 'data-analytics'],
            ],
            'it-strategy-consulting' => [
                'group' => 'Business Solutions',
                'title' => 'IT Strategy & Consulting',
                'short' => 'A clear technology roadmap aligned with business goals.',
                'icon' => 'strategy',
                'hero' => 'A Technology Roadmap That Actually Supports Your Business Goals',
                'subheadline' => 'We help leadership teams turn business objectives into a practical, prioritized technology plan.',
                'problem' => [
                    'Technology decisions are often made reactively, tool by tool, without a shared strategy connecting them to business outcomes.',
                    'This leads to fragmented systems, unclear ownership, and budget spent on the wrong priorities.',
                ],
                'solution' => [
                    'We work directly with leadership to understand business goals, assess current technology, and build a prioritized roadmap covering systems, infrastructure, and team capability.',
                    'The result is a plan your team can actually execute, with milestones you can measure against.',
                ],
                'features' => [
                    'Current-state technology assessment',
                    'Prioritized 12–24 month technology roadmap',
                    'Vendor and platform evaluation',
                    'IT budget planning and cost optimization',
                    'Ongoing advisory support',
                ],
                'benefits' => [
                    'Technology investment aligned with business priorities',
                    'Reduced wasted spend on the wrong tools',
                    'A clear plan the whole leadership team can align around',
                    'Confidence in long-term technology decisions',
                ],
                'related' => ['digital-transformation', 'cloud-solutions', 'it-infrastructure'],
            ],
            'cloud-solutions' => [
                'group' => 'Technology Solutions',
                'title' => 'Cloud Solutions',
                'short' => 'Reliable, scalable infrastructure without the overhead.',
                'icon' => 'cloud',
                'hero' => 'Infrastructure That Scales With Your Business',
                'subheadline' => 'We design, migrate, and manage cloud infrastructure so your systems stay fast, secure, and available.',
                'problem' => [
                    'On-premise servers are costly to maintain, difficult to scale, and often become a single point of failure.',
                    'Many businesses delay cloud migration because they are unsure how to do it without disrupting operations.',
                ],
                'solution' => [
                    'NEXORA plans and executes cloud migrations with minimal downtime, then configures infrastructure for performance, security, and cost efficiency.',
                    'We support major cloud providers and can recommend the right fit based on your workload and budget.',
                ],
                'features' => [
                    'Cloud readiness assessment and migration planning',
                    'Infrastructure setup and configuration',
                    'Auto-scaling and load balancing',
                    'Backup, disaster recovery, and monitoring',
                    'Cost optimization and ongoing management',
                ],
                'benefits' => [
                    'Lower infrastructure maintenance burden',
                    'Systems that scale automatically with demand',
                    'Improved uptime and disaster recovery',
                    'Predictable, optimized infrastructure costs',
                ],
                'related' => ['it-infrastructure', 'system-integration', 'cybersecurity'],
            ],
            'system-integration' => [
                'group' => 'Technology Solutions',
                'title' => 'System Integration',
                'short' => 'Connect your tools so data flows automatically.',
                'icon' => 'integration',
                'hero' => 'Make Your Systems Work as One',
                'subheadline' => 'We connect the applications your business already relies on, so information flows automatically between them.',
                'problem' => [
                    'Most businesses run several disconnected systems, an ERP, a CRM, accounting software, e-commerce platforms, each holding its own version of the truth.',
                    'Manual data transfer between them is slow and prone to costly errors.',
                ],
                'solution' => [
                    'We build reliable integrations and APIs that connect your existing systems, ensuring data stays consistent and up to date everywhere it is needed.',
                    'Integrations are designed to be resilient and monitored, so failures are caught before they affect the business.',
                ],
                'features' => [
                    'API design and development',
                    'Integration between ERP, CRM, and e-commerce platforms',
                    'Real-time data synchronization',
                    'Legacy system connectivity',
                    'Integration monitoring and alerting',
                ],
                'benefits' => [
                    'A single, consistent source of truth across systems',
                    'Elimination of manual data re-entry',
                    'Fewer errors from disconnected data',
                    'Faster reporting across the organization',
                ],
                'related' => ['enterprise-software', 'cloud-solutions', 'data-analytics'],
            ],
            'data-analytics' => [
                'group' => 'Technology Solutions',
                'title' => 'Data & Analytics',
                'short' => 'Turn scattered data into decisions you can trust.',
                'icon' => 'analytics',
                'hero' => 'Turn Business Data Into Clear, Actionable Insight',
                'subheadline' => 'We help you consolidate data from across the business and turn it into dashboards leadership can actually use.',
                'problem' => [
                    'Data is often spread across spreadsheets, systems, and departments, making it hard to get a single, trustworthy view of business performance.',
                    'Decisions end up based on intuition or outdated reports rather than current data.',
                ],
                'solution' => [
                    'We build data pipelines that consolidate information from your key systems, then design dashboards tailored to what each team actually needs to track.',
                    'Reports are automated wherever possible, so insight is always current without manual effort.',
                ],
                'features' => [
                    'Data pipeline and warehouse setup',
                    'Custom dashboards and KPI reporting',
                    'Automated scheduled reports',
                    'Data quality and governance practices',
                    'Training for teams on using dashboards',
                ],
                'benefits' => [
                    'A single, trustworthy view of business performance',
                    'Faster, evidence-based decision-making',
                    'Reduced time spent assembling manual reports',
                    'Early visibility into risks and opportunities',
                ],
                'related' => ['enterprise-software', 'system-integration', 'digital-transformation'],
            ],
            'it-infrastructure' => [
                'group' => 'Technology Solutions',
                'title' => 'IT Infrastructure',
                'short' => 'Dependable networks, servers, and IT foundations.',
                'icon' => 'infrastructure',
                'hero' => 'IT Infrastructure You Can Depend On',
                'subheadline' => 'We design, deploy, and maintain the networks, servers, and systems your business runs on every day.',
                'problem' => [
                    'Unreliable networks, aging hardware, and undocumented IT environments create risk and slow down every team that depends on them.',
                    'Without a clear infrastructure strategy, small issues tend to grow into major disruptions.',
                ],
                'solution' => [
                    'We assess your current infrastructure, address immediate risks, and design a stable, well-documented environment that is easier to maintain and expand.',
                    'Ongoing monitoring and maintenance keep systems healthy long after initial setup.',
                ],
                'features' => [
                    'Network design and infrastructure assessment',
                    'Server setup, virtualization, and hardening',
                    'Infrastructure monitoring and alerting',
                    'Documentation and standard operating procedures',
                    'Proactive maintenance and support',
                ],
                'benefits' => [
                    'Fewer unplanned outages and disruptions',
                    'A documented, maintainable IT environment',
                    'Infrastructure that supports future growth',
                    'Reduced risk from aging or unmanaged systems',
                ],
                'related' => ['cloud-solutions', 'cybersecurity', 'system-integration'],
            ],
        ];
    }

    /**
     * "Services" mega menu + /services/{slug} pages.
     */
    public static function services(): array
    {
        return [
            'it-consulting' => [
                'title' => 'IT Consulting',
                'short' => 'Independent advice on the technology decisions that matter.',
                'hero' => 'IT Consulting That Puts Your Business First',
                'subheadline' => 'Independent, vendor-neutral guidance to help you make confident technology decisions.',
                'problem' => [
                    'Technology vendors are quick to recommend their own products. Businesses need someone on their side who understands both the technical and the commercial trade-offs.',
                ],
                'solution' => [
                    'Our consultants assess your current environment, understand your goals, and provide clear, independent recommendations, without pushing a specific product or platform.',
                ],
                'features' => ['Technology audits and assessments', 'Vendor and platform evaluation', 'Project scoping and feasibility studies', 'IT governance and policy advisory'],
                'process' => ['Discover your goals and constraints', 'Assess current technology and gaps', 'Recommend a practical path forward', 'Support implementation as needed'],
                'benefits' => ['Independent, unbiased recommendations', 'Reduced risk on major technology decisions', 'Faster, more confident project scoping'],
            ],
            'web-development' => [
                'title' => 'Web Development',
                'short' => 'Fast, secure, and maintainable websites and web platforms.',
                'hero' => 'Websites and Web Platforms Built to Perform',
                'subheadline' => 'From corporate websites to complex web applications, built to be fast, secure, and easy to maintain.',
                'problem' => [
                    'Many business websites are slow, hard to update, or built on platforms that limit future growth, hurting both credibility and conversion.',
                ],
                'solution' => [
                    'We build websites and web applications using modern, maintainable frameworks, with a strong focus on performance, accessibility, and content that your team can manage independently.',
                ],
                'features' => ['Corporate and marketing websites', 'Custom web applications and portals', 'Content management systems', 'Performance and SEO optimization'],
                'process' => ['Discover requirements and goals', 'Design information architecture and UI', 'Develop and integrate systems', 'Deploy, test, and support'],
                'benefits' => ['Faster load times and better SEO performance', 'A platform your team can maintain long-term', 'A website built to convert visitors into leads'],
            ],
            'mobile-app-development' => [
                'title' => 'Mobile App Development',
                'short' => 'Native and cross-platform apps for iOS and Android.',
                'hero' => 'Mobile Apps That Extend Your Business',
                'subheadline' => 'We design and build mobile applications that give your customers or teams a reliable experience on the go.',
                'problem' => [
                    'Businesses often need a mobile presence but are unsure whether to build native, cross-platform, or a simple mobile-friendly web app, and get it wrong the first time.',
                ],
                'solution' => [
                    'We help you choose the right approach for your goals and budget, then design and build an app that is fast, intuitive, and easy to maintain across updates.',
                ],
                'features' => ['iOS and Android app development', 'Cross-platform development', 'App backend and API development', 'App store deployment and support'],
                'process' => ['Define scope and platform strategy', 'Design UX and interface', 'Build and test across devices', 'Launch and provide ongoing updates'],
                'benefits' => ['A mobile experience that matches your brand', 'Reduced development cost through cross-platform tooling', 'Ongoing support as operating systems evolve'],
            ],
            'ui-ux-design' => [
                'title' => 'UI/UX Design',
                'short' => 'Interfaces that are clear, usable, and on-brand.',
                'hero' => 'Design That Makes Technology Easier to Use',
                'subheadline' => 'We design interfaces that are intuitive for users and consistent with your brand.',
                'problem' => [
                    'Poorly designed interfaces cause confusion, support tickets, and lost customers, even when the underlying system works correctly.',
                ],
                'solution' => [
                    'Our design process focuses on real user needs, using research, wireframes, and prototypes to validate decisions before development begins.',
                ],
                'features' => ['User research and journey mapping', 'Wireframing and prototyping', 'Design systems and component libraries', 'Usability testing'],
                'process' => ['Research users and requirements', 'Wireframe and prototype', 'Design final interface and system', 'Validate through usability testing'],
                'benefits' => ['Reduced user confusion and support load', 'A consistent design system for future work', 'Higher engagement and conversion'],
            ],
            'erp-odoo' => [
                'title' => 'ERP & Odoo Implementation',
                'short' => 'Streamline operations with a properly configured ERP.',
                'hero' => 'One System for Your Entire Operation',
                'subheadline' => 'We implement and customize ERP systems, including Odoo, to bring your operations into a single, connected platform.',
                'problem' => [
                    'As businesses grow, finance, inventory, sales, and HR often end up in separate, disconnected tools, making reporting and coordination difficult.',
                ],
                'solution' => [
                    'We implement and configure ERP systems around your specific processes, migrate your existing data, and train your team so adoption actually sticks.',
                ],
                'features' => ['ERP requirements analysis and configuration', 'Odoo implementation and customization', 'Data migration from legacy systems', 'User training and change management'],
                'process' => ['Map current business processes', 'Configure and customize the ERP', 'Migrate and validate data', 'Train teams and go live'],
                'benefits' => ['One connected system across departments', 'More accurate, real-time reporting', 'Reduced duplicate data entry'],
            ],
            'cloud-management' => [
                'title' => 'Cloud & Server Management',
                'short' => 'Ongoing management so your infrastructure stays healthy.',
                'hero' => 'Infrastructure Management Without the In-House Burden',
                'subheadline' => 'We manage your cloud and server environments so your team can focus on the business, not the infrastructure.',
                'problem' => [
                    'Maintaining servers and cloud infrastructure requires specialized, ongoing attention that many businesses cannot justify hiring for full-time.',
                ],
                'solution' => [
                    'Our team takes ongoing responsibility for monitoring, patching, backups, and performance of your infrastructure, with clear reporting so you always know the status of your systems.',
                ],
                'features' => ['24/7 infrastructure monitoring', 'Patching and security updates', 'Backup and disaster recovery management', 'Performance tuning and cost management'],
                'process' => ['Assess and onboard current environment', 'Set up monitoring and alerting', 'Provide ongoing maintenance', 'Report regularly on health and performance'],
                'benefits' => ['Reduced risk of downtime and data loss', 'No need for a dedicated in-house infrastructure team', 'Predictable, transparent management costs'],
            ],
            'cybersecurity' => [
                'title' => 'Cybersecurity',
                'short' => 'Protect your systems, data, and reputation.',
                'hero' => 'Practical Cybersecurity for Growing Businesses',
                'subheadline' => 'We help you identify risks and put practical protections in place, without unnecessary complexity.',
                'problem' => [
                    'Cyber threats increasingly target small and mid-sized businesses that assume they are too small to be a target, often with costly consequences.',
                ],
                'solution' => [
                    'We assess your current security posture, close the highest-risk gaps first, and implement monitoring and policies appropriate to your size and industry.',
                ],
                'features' => ['Security assessments and audits', 'Network and endpoint protection', 'Access control and identity management', 'Security awareness training'],
                'process' => ['Assess current risk exposure', 'Prioritize and remediate key gaps', 'Implement monitoring and controls', 'Review and improve continuously'],
                'benefits' => ['Reduced risk of costly security incidents', 'Improved compliance posture', 'Greater confidence from customers and partners'],
            ],
            'maintenance-support' => [
                'title' => 'Maintenance & Support',
                'short' => 'Reliable, responsive support after launch.',
                'hero' => 'Ongoing Support You Can Rely On',
                'subheadline' => 'We provide ongoing maintenance and support so your systems keep running smoothly long after launch.',
                'problem' => [
                    'Many technology projects lose momentum after launch, leaving systems unmaintained and issues unresolved for weeks at a time.',
                ],
                'solution' => [
                    'We offer structured support plans covering bug fixes, updates, and small enhancements, with clear response times and a dedicated point of contact.',
                ],
                'features' => ['Bug fixes and issue resolution', 'Regular updates and patching', 'Ongoing small enhancements', 'Support SLAs and dedicated contact'],
                'process' => ['Define support scope and SLA', 'Monitor systems proactively', 'Resolve issues within agreed timelines', 'Review and plan improvements regularly'],
                'benefits' => ['Faster resolution when issues arise', 'Systems that stay current and secure', 'A dedicated partner instead of a one-off vendor'],
            ],
        ];
    }

    /**
     * "Industries" mega menu + /industries/{slug} pages.
     */
    public static function industries(): array
    {
        return [
            'manufacturing' => [
                'title' => 'Manufacturing',
                'short' => 'Connect production, inventory, and operations.',
                'hero' => 'Technology for Modern Manufacturing Operations',
                'problems' => ['Disconnected production and inventory tracking', 'Limited visibility into machine downtime and output', 'Manual, error-prone quality and compliance reporting'],
                'solutions' => ['Production and inventory management systems', 'Real-time operations dashboards', 'Integration between shop floor systems and ERP'],
                'examples' => ['Inventory and warehouse management platform', 'Production monitoring dashboard', 'Quality control and compliance tracking system'],
                'benefits' => ['Better visibility into production performance', 'Reduced downtime through early issue detection', 'More accurate inventory and planning'],
            ],
            'healthcare' => [
                'title' => 'Healthcare',
                'short' => 'Secure systems for patient care and operations.',
                'hero' => 'Reliable, Secure Technology for Healthcare Providers',
                'problems' => ['Fragmented patient records across systems', 'Scheduling and administrative overhead', 'Strict requirements around data privacy and security'],
                'solutions' => ['Secure patient management and records systems', 'Appointment scheduling and workflow automation', 'Data protection aligned with healthcare privacy standards'],
                'examples' => ['Patient management and scheduling platform', 'Secure records and document system', 'Administrative workflow automation'],
                'benefits' => ['Improved patient experience and reduced wait times', 'Stronger data security and privacy compliance', 'Less administrative burden on clinical staff'],
            ],
            'education' => [
                'title' => 'Education',
                'short' => 'Systems that support learning and administration.',
                'hero' => 'Technology That Supports Institutions and Students',
                'problems' => ['Manual student administration and record-keeping', 'Disconnected tools for learning and communication', 'Difficulty scaling systems as enrollment grows'],
                'solutions' => ['Student information and administration systems', 'Learning management and communication platforms', 'Reporting tools for academic performance'],
                'examples' => ['Student information system', 'Learning management platform', 'Institution reporting dashboard'],
                'benefits' => ['Reduced administrative workload for staff', 'Better communication between institution, students, and parents', 'Systems that scale with growing enrollment'],
            ],
            'retail' => [
                'title' => 'Retail & E-Commerce',
                'short' => 'Unify online and offline operations.',
                'hero' => 'Technology for Modern Retail and E-Commerce',
                'problems' => ['Disconnected online and offline sales channels', 'Inventory mismatches between store and web', 'Limited visibility into customer behavior and sales trends'],
                'solutions' => ['E-commerce platforms integrated with inventory and POS', 'Unified inventory management across channels', 'Sales and customer analytics dashboards'],
                'examples' => ['E-commerce platform with inventory sync', 'Point-of-sale and inventory integration', 'Customer and sales analytics dashboard'],
                'benefits' => ['Consistent inventory across all sales channels', 'Better understanding of customer behavior', 'A smoother buying experience that improves conversion'],
            ],
            'finance' => [
                'title' => 'Finance',
                'short' => 'Secure, accurate systems for financial operations.',
                'hero' => 'Dependable Technology for Financial Operations',
                'problems' => ['Manual reconciliation and reporting processes', 'Strict security and compliance requirements', 'Disconnected systems across finance and operations'],
                'solutions' => ['Automated reporting and reconciliation tools', 'Secure infrastructure aligned with compliance requirements', 'Integration between financial and operational systems'],
                'examples' => ['Automated financial reporting system', 'Secure client and transaction platform', 'Compliance and audit tracking tools'],
                'benefits' => ['More accurate, timely financial reporting', 'Stronger security and compliance posture', 'Reduced manual reconciliation effort'],
            ],
            'government' => [
                'title' => 'Government & Public Services',
                'short' => 'Digital services for public institutions.',
                'hero' => 'Digital Solutions for Public Sector Services',
                'problems' => ['Paper-based processes that slow down public services', 'Limited digital access for citizens', 'Legacy systems that are costly to maintain'],
                'solutions' => ['Digital service portals for citizens and staff', 'Workflow automation for administrative processes', 'Modernization of legacy systems'],
                'examples' => ['Public service request portal', 'Internal workflow and case management system', 'Legacy system modernization project'],
                'benefits' => ['Faster, more accessible public services', 'Reduced administrative backlog', 'Lower long-term maintenance costs'],
            ],
            'startup' => [
                'title' => 'Startup & Technology',
                'short' => 'Build a solid technical foundation, fast.',
                'hero' => 'A Technical Foundation That Grows With Your Startup',
                'problems' => ['Limited engineering resources to build and maintain product', 'Technical decisions made under time pressure', 'Infrastructure that needs to scale quickly if the product takes off'],
                'solutions' => ['MVP and product development support', 'Scalable architecture and infrastructure setup', 'Ongoing technical advisory as the team grows'],
                'examples' => ['MVP product build', 'Scalable cloud infrastructure setup', 'Technical roadmap and advisory support'],
                'benefits' => ['Faster time to market for new products', 'Infrastructure built to handle growth', 'Access to senior technical expertise without full-time hires'],
            ],
        ];
    }

    /**
     * Insights / blog articles.
     */
    public static function insights(): array
    {
        return [
            'digital-transformation-business' => [
                'category' => 'Digital Transformation',
                'title' => 'How Digital Transformation Helps Modern Businesses',
                'excerpt' => 'Digital transformation is no longer optional. Here is what it actually means for a growing business, in practical terms.',
                'author' => 'NEXORA Editorial Team',
                'date' => '2026-08-12',
                'body' => [
                    ['type' => 'p', 'text' => 'For many business leaders, "digital transformation" sounds like a buzzword attached to expensive projects with unclear outcomes. In practice, it simply means using technology to make your operations faster, more consistent, and easier to manage as you grow.'],
                    ['type' => 'h', 'text' => 'What digital transformation actually looks like'],
                    ['type' => 'p', 'text' => 'For most mid-sized businesses, digital transformation does not mean replacing every system overnight. It usually starts with smaller, targeted changes: automating a manual approval process, connecting two systems that currently require manual data entry, or replacing a spreadsheet-based process with a proper system.'],
                    ['type' => 'list', 'items' => ['Automating repetitive administrative tasks', 'Connecting previously disconnected systems', 'Making business data visible in real time', 'Standardizing processes across teams and locations']],
                    ['type' => 'h', 'text' => 'Why it matters now'],
                    ['type' => 'p', 'text' => 'Businesses that delay these changes often find that manual processes become harder to unwind as they scale. What was a minor inconvenience at ten employees becomes a serious bottleneck at fifty.'],
                    ['type' => 'p', 'text' => 'Starting with a clear, prioritized roadmap, rather than attempting everything at once, is usually the difference between a transformation effort that sticks and one that stalls.'],
                ],
            ],
            'cloud-infrastructure' => [
                'category' => 'Cloud',
                'title' => 'Why Businesses Need Cloud Infrastructure',
                'excerpt' => 'On-premise servers come with hidden costs and risks. Here is why more businesses are moving to the cloud, and how to do it safely.',
                'author' => 'NEXORA Editorial Team',
                'date' => '2026-07-28',
                'body' => [
                    ['type' => 'p', 'text' => 'Maintaining physical servers requires more than just buying hardware. It means ongoing maintenance, cooling, security, backups, and eventually replacement, all of which carry real, often underestimated cost.'],
                    ['type' => 'h', 'text' => 'The case for cloud infrastructure'],
                    ['type' => 'p', 'text' => 'Cloud infrastructure shifts that burden to specialized providers, while giving businesses the flexibility to scale resources up or down based on actual demand rather than worst-case capacity planning.'],
                    ['type' => 'list', 'items' => ['Lower upfront hardware investment', 'Ability to scale resources on demand', 'Improved backup and disaster recovery options', 'Reduced burden on internal IT teams']],
                    ['type' => 'h', 'text' => 'Migrating without disruption'],
                    ['type' => 'p', 'text' => 'The biggest concern businesses have about cloud migration is downtime. A well-planned migration, executed in phases with proper testing, can be done with minimal disruption to daily operations.'],
                ],
            ],
            'erp-for-growing-business' => [
                'category' => 'ERP',
                'title' => 'Understanding ERP for Growing Companies',
                'excerpt' => 'As businesses grow, disconnected tools become a liability. Here is how ERP systems solve that, and how to know when you need one.',
                'author' => 'NEXORA Editorial Team',
                'date' => '2026-07-10',
                'body' => [
                    ['type' => 'p', 'text' => 'ERP, or Enterprise Resource Planning, refers to systems that bring finance, inventory, sales, and operations together into a single platform, rather than leaving them scattered across separate tools.'],
                    ['type' => 'h', 'text' => 'Signs you may need an ERP'],
                    ['type' => 'list', 'items' => ['Finance and operations teams rely on separate, disconnected spreadsheets', 'Reports take days to compile because data lives in multiple places', 'Inventory counts frequently do not match what is recorded in the system', 'Onboarding new staff to your current tools takes longer than it should']],
                    ['type' => 'h', 'text' => 'Making ERP implementation succeed'],
                    ['type' => 'p', 'text' => 'The biggest risk in ERP projects is not the software itself, but poor process mapping and inadequate training. A successful implementation starts by understanding how your business actually works, then configuring the system to match, not the other way around.'],
                ],
            ],
            'business-automation' => [
                'category' => 'Business',
                'title' => 'Improving Business Efficiency Through Automation',
                'excerpt' => 'Small pockets of manual work add up. Here is how targeted automation can return meaningful time back to your team.',
                'author' => 'NEXORA Editorial Team',
                'date' => '2026-06-22',
                'body' => [
                    ['type' => 'p', 'text' => 'Automation does not need to be dramatic to be valuable. Some of the highest-impact automation projects address small, repetitive tasks that quietly consume hours of staff time every week.'],
                    ['type' => 'h', 'text' => 'Where to start'],
                    ['type' => 'p', 'text' => 'The best candidates for automation are tasks that are repetitive, rule-based, and currently done manually, things like data entry between systems, routine approvals, and recurring report generation.'],
                    ['type' => 'list', 'items' => ['Data entry and synchronization between systems', 'Approval routing and notifications', 'Recurring reports and document generation', 'Scheduled reminders and follow-ups']],
                    ['type' => 'h', 'text' => 'Measuring the impact'],
                    ['type' => 'p', 'text' => 'Before automating, it is worth measuring how much time a process currently takes. This makes it much easier to demonstrate the return on investment once automation is in place, and to prioritize the next opportunity.'],
                ],
            ],
            'cybersecurity-basics' => [
                'category' => 'IT Security',
                'title' => 'Cybersecurity Basics for Modern Companies',
                'excerpt' => 'You do not need an enterprise security budget to meaningfully reduce risk. Here are the fundamentals every business should have in place.',
                'author' => 'NEXORA Editorial Team',
                'date' => '2026-06-05',
                'body' => [
                    ['type' => 'p', 'text' => 'Many smaller businesses assume they are not a target for cyber threats. In reality, attackers often prefer smaller organizations precisely because their defenses tend to be weaker.'],
                    ['type' => 'h', 'text' => 'The fundamentals'],
                    ['type' => 'list', 'items' => ['Enforce strong, unique passwords and multi-factor authentication', 'Keep software and systems patched and up to date', 'Limit access based on role, not convenience', 'Maintain regular, tested backups', 'Train staff to recognize phishing and social engineering attempts']],
                    ['type' => 'h', 'text' => 'Building from there'],
                    ['type' => 'p', 'text' => 'Once the fundamentals are in place, businesses can layer on more advanced protections such as network monitoring and formal incident response plans, prioritized based on actual risk rather than fear.'],
                ],
            ],
        ];
    }

    public static function team(): array
    {
        return [
            ['name' => 'Andra Wicaksono', 'role' => 'Managing Director', 'expertise' => 'IT strategy, enterprise consulting'],
            ['name' => 'Dinda Prameswari', 'role' => 'Head of Engineering', 'expertise' => 'Enterprise software, system architecture'],
            ['name' => 'Raka Santosa', 'role' => 'Head of Cloud & Infrastructure', 'expertise' => 'Cloud migration, infrastructure management'],
            ['name' => 'Maya Kusuma', 'role' => 'Lead UI/UX Designer', 'expertise' => 'Product design, design systems'],
            ['name' => 'Fajar Nugraha', 'role' => 'ERP Implementation Lead', 'expertise' => 'Odoo, business process design'],
            ['name' => 'Sari Handayani', 'role' => 'Head of Cybersecurity', 'expertise' => 'Security audits, infrastructure hardening'],
        ];
    }

    public static function careers(): array
    {
        return [
            ['title' => 'Senior Full-Stack Developer', 'type' => 'Full-time · Hybrid', 'summary' => 'Build and maintain enterprise web applications for our clients across multiple industries.'],
            ['title' => 'Cloud Infrastructure Engineer', 'type' => 'Full-time · Hybrid', 'summary' => 'Design, migrate, and manage cloud infrastructure for growing businesses.'],
            ['title' => 'UI/UX Designer', 'type' => 'Full-time · On-site', 'summary' => 'Design intuitive interfaces for enterprise software and client-facing products.'],
            ['title' => 'ERP / Odoo Consultant', 'type' => 'Full-time · Hybrid', 'summary' => 'Implement and configure ERP systems tailored to client operations.'],
            ['title' => 'IT Business Analyst', 'type' => 'Full-time · Hybrid', 'summary' => 'Bridge business requirements and technical delivery on consulting engagements.'],
        ];
    }

    public static function partners(): array
    {
        return [
            'Cloud Infrastructure Partners' => ['Amazon Web Services', 'Google Cloud Platform', 'Microsoft Azure'],
            'Enterprise Software Partners' => ['Odoo', 'Microsoft 365', 'Salesforce'],
            'Security & Monitoring Partners' => ['Cloudflare', 'Datadog', 'Okta'],
        ];
    }
}
