# Plater-corpus

This repository contains corpus examples for [Plater](https://github.com/RobotsWar/Plater),
the 3D printer build plate generator. The purpose of this is to test and benchmark the plating
system.

## Sources

Objects of this repository comes from real projects:

* `darwin_mini/` parts of the [DARWIN Mini humanoid robot](http://www.thingiverse.com/thing:323906)
* `heart/` is an [heart gears](http://www.thingiverse.com/thing:249341)
* `octopus`, an [octopus](http://www.thingiverse.com/thing:27053/), choosed because of its numerous facets
* `prusa/` is a rework of the [Prusa i3 3D printer parts](http://www.thingiverse.com/thing:119616)
* `robotic_arm_6dof/` a [6 DOF robotic arm](http://www.thingiverse.com/thing:30163)
* `shower_curtain_hooks/` 12 [hooks for shower](http://www.thingiverse.com/thing:238167)
* `spider_rover/` a [Spider rover robot](https://www.youmagine.com/designs/spider-rover) (without deck big parts)
* `spidey/` comes from the [Spidey robotics platform](https://github.com/RobotsWar/Spidey)
* `um2-extruder/` is an [Ultimaker2 extruder upgrade](https://www.youmagine.com/designs/extruder-um2-version-2)

## Benchmark conditions

### Plates size

Here are build plates size that we use in the benchmark:

* 28 x 15 cm (size of the Makerbot Replicator 2)
* 21 x 21 cm (size of the Ultimaker2)
* 20 x 15 cm 
* 15 x 15 cm

### Threading

You can use several threads for multi-core computers. Don't forget to include the number of thread
in the benchmark if you consider publishing it.

### Score

The score of each benchmark is:

* The time of execution
* The number of plate that contains all the parts
