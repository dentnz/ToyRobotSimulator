# Toy Robot Simulator

Karl Lurman's <karl.lurman@gmail.com> implementation of the 
Toy Robot Simulator.

## Design/Development Notes

- Two traits were constructed. One that deals with keeping a 
direction, **CanFaceDirection**. Another dealing with moving positions,
**CanMovePosition**.
- **CanFaceDirection** deals with maintaining an objects facing direction.
- **CanMovePosition** actually has two internal **Position** references. 
This provides the ability to determine what would be the next
position of the moving object, WITHOUT actually moving it.
- A **Robot** instance encapsulates it's own position and direction
through the objects created by the two traits.
- A **Tabletop** has dimensions and out of bounds checking.
- **Simulator** brings together the **Robot**, **Tabletop**,
and **Console** objects (through injection). When run, it handles commands,
- I whipped up a **Tester** to do my TDD instead of installing PHP Unit.

## Testing/Running the Simulator

Unit tests can be run as follows:

```
> cd Tests
> php Tests.php
```

To run the application in console input loop mode:

```
> php Simulator.php
```

User can enter commands as required. Ctrl+C or the EXIT command will quit.

To run the supplied examples in a single script:

```
> cat testscript.txt | php Simulator.php
```

## Possible Future Work

- **Simulator** refactored quite easily to deal with:
1) Additional Toy types - create a **Toy** interface/abstract.
2) Multiple Toys/items at the same time - perhaps with collision 
detection
3) Move logging (Event sourcing pattern)
4) Custom exceptions could be added for better error handling
- **CanFaceDirection** could be extended to have eight directions
directions, e.g NORTH EAST. Construction of a **Direction** class
could provide an abstraction around faceable directions. 
**CanMovePosition** could then be extended to cope with movement in 
additional directions.
- **CanMovePosition** reference a MoveUnits variable representing
the number of units an object would move forward. Each object could
then override this variable if required.
- **CanMovePosition** could be extended from to create specific
movement traits (e.g Chess moves).
- 
