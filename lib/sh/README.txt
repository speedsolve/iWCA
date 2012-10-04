Export of the World Cube Association results database

Date:     September 29, 2012
Remarks:  none
Contact:  Ron van Bruchem Netherlands rbruchem@worldcubeassociation.org
Website:  http://www.worldcubeassociation.org/results

Description:
  This file contains public information on all official WCA competitions,
  WCA members and WCA competition results.

Goal:
  Goal of this file is for members of our community to do analysis on the
  information for statistical and personal purposes.

Allowed use: Information and parts of it may be published online,
but only under the following conditions:
  - A clearly visible link to World Cube Association website is added
    (http://www.worldcubeassociation.org) with the notification that
    World Cube Association is the source and owner of the information.
  - A clearly visible notification is added that the published information
    is not actual information.
  - A clearly visible link to http://www.worldcubeassociation.org/results is
    added with the notification that the actual information can be found via
    that link.
  - A clearly visible notification which date is taken for the source of the data.
  - The style and format of the information must be clearly distinguishable
    from the official WCA website

Software created by:
  Cl�ment Gallet    France
  Stefan Pochmann   Germany
  Josef Jelinek     Czech Republic
  Ron van Bruchem   Netherlands


The export consists of these tables:
  Persons        WCA competitors
  Competitions   WCA competitions
  Events         WCA events (Rubik's Cube, Megaminx, etc)
  Results        WCA results per competition+event+round+person
  RanksSingle    Best single result per competitor+event and ranks
  RanksAverage   Best average result per competitor+event and ranks
  Rounds         The round types (first, final, etc)
  Formats        The round formats (best of 3, average of 5, etc)
  Countries      Countries according to http://en.wikipedia.org/wiki/List_of_countries
  Continents     Continents

Most of the tables should be self-explanatory, but the result values of
the Results table need some explanation:

- The result values are in fields value1-value5, best and average.
- Value -1 means DNF
- Value -2 means DNS
- Value 0 means "nothing", for example a best-of-3 has value4=value5=average=0
- Positive values depend on the event, see column "format" in Events.
  - Most events have format "time", where the value represents centiseconds.
    For example, 8653 means 1 minute and 26.53 seconds.
  - Format "number" means the value is a raw number, currently only used
    by "fewest moves" for number of moves.
  - Format "multi" is for old and new multi-blind, encoding not only the time
    but also the number of attempted and solved cubes. Writing the value in
    decimal it is interpreted like this:
      old: 1SSAATTTTT
             solved        = 99 - SS
             attempted     = AA
             timeInSeconds = TTTTT (99999 means unknown)
      new: 0DDTTTTTMM
             difference    = 99 - DD
             timeInSeconds = TTTTT (99999 means unknown)
             missed        = MM
             solved        = difference + missed
             attempted     = solved + missed
    Note that this is designed so that a smaller value means a better result.
