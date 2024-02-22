To prevent XML Entity Expansion attacks and mitigate the risk of unrestricted resource consumption, the application should:
Validate and sanitize input data, including XML files(only), to prevent malicious payloads.
Use XML parsers that disable external entity resolution by default or configure them to reject external entities.
Implement rate limiting or resource quotas to restrict the amount of resources that can be consumed by individual requests.
Monitor resource usage and implement alerting mechanisms to detect and respond to abnormal spikes in resource consumption.
