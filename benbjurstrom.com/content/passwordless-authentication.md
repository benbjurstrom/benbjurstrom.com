---
title: Passwordless Authentication for Laravel
date: "2024-11-17T08:00:00.000Z"
excerpt: Should you use Socal Login, One-Time Passwords, Magic Links, or Passkeys for Passwordless Authentication?
author: [Ben Bjurstrom, "https://benbjurstrom.com.s3-us-west-2.amazonaws.com/img/headshot.jpg"]
image: /prezet/img/ogimages/pgvector-for-laravel-scout.webp
draft: true
---

So you don't want the responsibility of managing user's passwords and want to move to a passwordless login system. I don't blame you.



But which one do you pick? One-time passwords (OTPs), magic links, or social authentication?

Thankfully, auth-as-a-service provider clerk.dev recently [published data](https://x.com/tweetsbycolin/status/1857900968245072087) from 2.5 million sign-ins that reveals some interesting patterns. When given an option between Sign In with Google, password based auth, an emailed OTP, or an emailed Magic Link, a whopping 65% of users chose Sign in with Google. In a distant second traditional passwords came in at 27%, meanwhile the email based solutions came in at 5.3% for OTPs and an abysmal 1.6% for magic links.

Additionally, the data shows that the time it takes to sign in with Google averages just 3.86 seconds, far outpacing the times for other strategies such as passwords (7.22 seconds), OTPs (42.84 seconds), and magic links (56.85 seconds). I first want to explore why these patterns emerge and what they mean for your authentication strategy. Then I want to take a look at the passwordless options available for the Laravel Framework.
## The Case for Passwordless Authentication

Before we dive in, let's address why you might want to offer passwordless options in the first place. While power users with password managers might prefer traditional password-based authentication, the reality is that many users:

- Reuse passwords across multiple sites.
- Create weak, memorable passwords.
- Require email based "forgot password" workflows.
- Need email verification regardless of login method.

This last point is particularly important: if your application requires email verification anyway (as most non-trivial apps do), incorporating email-based authentication from the start can streamline the user experience.
## Looking Deeper Into The Data
When you look at the clerk.dev data, we see a strong correlation between the time it takes for a successful sign-in and the percentage of users who choose that option. It seems clear that the two email-based authentication methods, OTPs and Magic Links, are the least popular because they take on average almost a minute to complete the successful sign-on.

A lot of that time is probably just waiting for the actual email to be delivered, but in other cases it might be that the user has to authenticate with their email provider in order to click the link or obtain the one-time password. If that's true, then why do OTP sign ins happen on average 14 seconds faster than Magic Links?

I would argue the reason OTPs are faster and thus more preferred is because of the prevalence of smart devices. Almost everybody has a phone in their pocket that's already authenticated to their email. Therefore, it's often much faster to just pull out your phone or look at your watch to find the code then it would be to open up your email account on the authenticating device.

But before we chose OTPs and call it a day let's take a closer look at the differences between the choices by looking at the following chart.

![](Social%20Login,%20One-Time%20Passwords,%20or%20Magic%20Links%20for%20Passwordless%20Authentication?-20241212135305463.webp)

One of the things that stands out to me is that Magic Links are one of the most secure forms of authentication, since they can't be phished. But it comes at a cost that the user be authenticated with their email provider on the device being authenticated.

Meanwhile an OTP can be viewed on a secondary device such as a phone or smartwatch, which is especially useful for logging into a device without email access such as a Smart TV or Gaming Console.

Passkeys offer another excellent option as a secure, quick way to authenticate a user. But if you're using passkeys for signup you still need to verify their email.

### So Which Passwordless Option Should You Choose?

I would argue that instead of choosing a single passwordless option, you should choose several. Almost certainly, based on the clerk.dev data, if you don't offer traditional passwords, you should almost certainly offer some form of social login. Setting up login with Google is trivially easy especially in a Laravel app using the socialite package.

There's a lot of replies under the aforementioned clerk.dev tweet that say things like, "if the only way to authenticate with your app is via email, I'm not going to sign into your app." They argue that the cost of context switching your browser window to your email client, or just generally getting distracted while waiting for the email to come in is too high.

The added benefit of allowing social auth with a trusted provider like Google or Apple is you can most likely treat the email address you receive as verified, which again streamlines the user experience.

However, not everyone has a Google account and more importantly not everyone is authenticated into their Google account on the device they're trying to sign into your app with. Therefore, you need to offer a fallback solution which is where OTPs or Magic Links make sense.

### The perfect login stack
The ideal authentication strategy likely involves multiple options:

- **Social login** as the primary method (e.g., "Sign in with Google")
- OTPs as a fallback for people who either don't have google, or aren't signed in to their google account on the device being authenticated.
- Passkey's as a login option the user can enable but not a registration option.

This combination provides:

- Quick authentication for the majority (70%) through social login
- Email verification built into the registration process
- Fallback options for users without social accounts
- Enhanced security options for power users

Consider the user journey: A new user signs up with social login, getting immediate access with a verified email. If they later can't access their social account, they can use the passwordless fallback. Finally, they can set up a passkey for future quick access.

## Implementation Considerations

When implementing either OTPs or magic links, several factors deserve attention:

- Rate limiting to prevent abuse
- Expiration times for security
- Email template design for clear communication
- Audit logging for security monitoring
- Event tracking for metrics and monitoring

### Laravel Implementation Options

For Laravel developers, two packages provide robust implementations of these authentication methods:

#### Plink: Secure Magic Links

Plink offers:

- Session-locked magic links for enhanced security
    
- Protection against email security scanner interference
    
- Configurable expiration times
    
- Built-in rate limiting
    
- Modern email templates
    
- Comprehensive event system for monitoring
    

#### OTPZ: Simple One-Time Passwords

OTPZ (pronounced "OTP-easy") provides:

- Secure one-time password implementation
    
- Configurable rate limiting
    
- Customizable expiration times
    
- Beautiful email templates
    
- Full audit logging
    
- Event-driven architecture
    

Both packages include database tracking for security auditing and emit events at key moments (creation, attempts, authentication) for easy monitoring integration.

## Making the Choice

Your choice between OTPs and magic links should consider your specific use case:

**Choose OTPs if:**

- You need to support devices without email clients
    
- User convenience is a top priority
    
- You have additional security measures in place
    

**Choose magic links if:**

- Maximum security is essential
    
- Email client access isn't a concern
    
- You want to prevent phishing attempts
    

Remember, you can enhance security for either option by adding second-factor authentication through time-based tokens or passkeys for sensitive applications.

## Conclusion

While social login dominates user preferences, offering passwordless options remains crucial for a complete authentication strategy. OTPs provide better usability at the cost of some security, while magic links offer enhanced security with some convenience trade-offs. The best approach often combines multiple methods, allowing users to choose based on their needs and circumstances.

Whether you choose OTPs, magic links, or both, ensure your implementation considers security, user experience, and maintenance. For Laravel developers, both Plink and OTPZ provide production-ready solutions with the features needed for secure, user-friendly authentication.







