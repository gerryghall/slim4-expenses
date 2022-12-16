# 3. use ADR design Pattern

Date: 14-12-2022

## Status

Accepted

## Context

* The **Action** then invokes the renderers with the data
  it needs to build an HTTP Response.
* The **Domain**
By separating domain from infrastructure code you automatically **increase testability**
because you can replace the implementation by changing the adapter without affecting
the interfaces.
* The **Renderer** builds an HTTP response using the data fed to it by the **Action**.

## Decision
Use ADR for Increases Testability and usability.

## Consequences

Keeps the code clean by keeps all un bound data within the Repository interface
Increases Testability and usability.
