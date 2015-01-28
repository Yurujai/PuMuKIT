<?php

namespace Pumukit\SchemaBundle\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;
use Pumukit\SchemaBundle\Document\SeriesType;

/**
 * SeriesRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SeriesRepository extends DocumentRepository
{
    public function findByTag(Tag $tag)
    {
        $dm = $kernel->getContainer()->get('doctrine_mongodb')->getManager();
        $qb = $dm->createQueryBuilder('PumukitSchemaBundle:Series')->field('multimedia_objects')->field('tags')->equals($tag)->sort('public_date', 'desc');
        $query = $qb->getQuery();
        $results = $query->execute();
    /*
      $query = $dm->createQuery('SELECT s
      FROM PumukitSchemaBundle:Series s
      JOIN s.multimedia_objects mm
      JOIN mm.tags t
      WHERE t = :tag
      ORDER BY s.public_date DESC')
      ->setParameter('tag', $tag);

      return $query->getResult();*/
    return $results;
    }

    public function findOneByTag(Tag $tag)
    {
        $dm = $this->$kernel->getContainer()->get('doctrine_mongodb')->getManager();
        $qb = $dm->createQueryBuilder('PumukitSchemaBundle:Series')->field('multimedia_objects')->field('tags')->equals($tag)->sort('public_date', 'desc');
        $query = $qb->getQuery()->getSingleResult();
        $results = $query->execute();
    /*
      $query = $dm->createQuery('SELECT s
      FROM PumukitSchemaBundle:Series s
      JOIN s.multimedia_objects mm
      JOIN mm.tags t
      WHERE t = :tag
      ORDER BY s.public_date DESC')
      ->setParameter('tag', $tag)
      ->setMaxResults(1);

      return $query->getSingleResult();
    */
    return $results;
    }

    public function findWithAnyTag(array $tags)
    {
        $dm = $this->$kernel->getContainer()->get('doctrine_mongodb')->getManager();
        $qb = $dm->createQueryBuilder('PumukitSchemaBundle:Series')->field('multimedia_objects')->field('tags')->in($tags)->sort('public_date', 'desc');
        $query = $qb->getQuery();
        $results = $query->execute();
    /*
      $query = $dm->createQuery('SELECT s
      FROM PumukitSchemaBundle:Series s
      JOIN s.multimedia_objects mm
      JOIN mm.tags t
      WHERE t IN (:tags)
      ORDER BY s.public_date DESC')
      ->setParameter('tags', $tags);

      return $query->getResult();*/
    return $results;
    }

    public function findWithAllTags(array $tags)
    {
        $dm = $this->$kernel->getContainer()->get('doctrine_mongodb')->getManager();
        $qb = $dm->createQueryBuilder('PumukitSchemaBundle:Series')->field('multimedia_objects')->field('tags')->all($tags)->sort('public_date', 'desc');
        $query = $qb->getQuery();
        $results = $query->execute();
    /*
      $query = $dm->createQuery('SELECT s
      FROM PumukitSchemaBundle:Series s
      JOIN s.multimedia_objects mm
      JOIN mm.tags t
      WHERE t IN (:tags)
      GROUP BY mm
      HAVING COUNT(t) = :numtags
      ORDER BY s.public_date DESC')
      ->setParameter('numtags', count($tags))
      ->setParameter('tags', $tags);

      return $query->getResult();*/
    return $results;
    }

    public function findOneWithAllTags(array $tags)
    {
        $dm = $this->$kernel->getContainer()->get('doctrine_mongodb')->getManager();
        $qb = $dm->createQueryBuilder('PumukitSchemaBundle:Series')->field('multimedia_objects')->field('tags')->all($tags)->sort('public_date', 'desc');
        $query = $qb->getQuery()->getSingleResult();
        $results = $query->execute();
    /*
      $query = $dm->createQuery('SELECT s
      FROM PumukitSchemaBundle:Series s
      JOIN s.multimedia_objects mm
      JOIN mm.tags t
      WHERE t IN (:tags)
      GROUP BY mm
      HAVING COUNT(t) = :numtags
      ORDER BY s.public_date DESC')
      ->setParameter('numtags', count($tags))
      ->setParameter('tags', $tags)
      ->setMaxResults(1);

      return $query->getSingleResult();*/
    return $results;
    }

    public function findWithoutTag(Tag $tag)
    {
        $dm = $this->kernel->getContainer()->get('doctrine_mongodb')->getManager();
        $qb = $dm->createQueryBuilder('PumukitSchemaBundle:Series')->field('multimedia_objects')->field('tags')->equals($tag)->sort('public_date', 'desc');
        $query = $qb->getQuery();
        $results = $query->execute();
    /*
      $query = $dm->createQuery('SELECT s
      FROM PumukitSchemaBundle:Series s
      WHERE s NOT IN(SELECT se
      FROM PumukitSchemaBundle:Series se
      JOIN se.multimedia_objects mm
      JOIN mm.tags t
      WHERE t = :tag
      GROUP BY se
      ORDER BY se.public_date DESC)')
      ->setParameter('tag', $tag);

      return $query->getResult();*/
    return $results;
    }

    public function findOneWithoutTag(Tag $tag)
    {
        $dm = $this->$kernel->getContainer()->get('doctrine_mongodb')->getManager();
        $qb = $dm->createQueryBuilder('PumukitSchemaBundle:Series')->field('multimedia_objects')->field('tags')->equals($tag)->sort('public_date', 'desc');
        $query = $qb->getQuery()->getSingleResult();
        $results = $query->execute();
    /*
      $query = $dm->createQuery('SELECT s
      FROM PumukitSchemaBundle:Series s
      WHERE s NOT IN(SELECT se
      FROM PumukitSchemaBundle:Series se
      JOIN se.multimedia_objects mm
      JOIN mm.tags t
      WHERE t = :tag
      GROUP BY se
      ORDER BY se.public_date DESC)')
      ->setParameter('tag', $tag)
      ->setMaxResults(1);

      return $query->getSingleResult();*/
    return $results;
    }

  // Note: Maybe a "Find without metatag (category) and children" would be useful
  /**
   * Find series that do not contain SIMULTANEOUSLY all the given tags.
   * Series containing a subset of given tags would be returned.
   *
   * @param Array (Tag) $tags
   * @return Array
   */
  public function findWithoutAllTags(array $tags)
  {
      $dm = $this->$kernel->getContainer()->get('doctrine_mongodb')->getManager();
      $qb = $dm->createQueryBuilder('PumukitSchemaBundle:Series')->field('multimedia_objects')->field('tags')->notIn($tags)->sort('public_date', 'desc');
      $query = $qb->getQuery();
      $results = $query->execute();
    /*
      $query = $dm->createQuery('SELECT se
      FROM PumukitSchemaBundle:Series se
      WHERE se NOT IN(SELECT s
      FROM PumukitSchemaBundle:Series s
      JOIN s.multimedia_objects mm
      JOIN mm.tags t
      WHERE t IN (:tags)
      GROUP BY mm
      HAVING COUNT(t) = :numtags
      ORDER BY s.public_date DESC)')
      ->setParameter('numtags', count($tags))
      ->setParameter('tags', $tags);

      return $query->getResult();*/
    return $results;
  }

  // TO DO: check if LEFT JOIN will miss mmo without tags (null)
  // If it does not, it would be possible to make a simpler query.
  /**
   * Find series that do not contain any of the given tags.
   * Series containing a subset of given tags would NOT be returned.
   *
   * @param Array (Tag) $tags
   * @return Array
   */
  public function findWithoutSomeTags(array $tags)
  {
      $dm = $this->$kernel->getContainer()->get('doctrine_mongodb')->getManager();
      $qb = $dm->createQueryBuilder('PumukitSchemaBundle:Series')->field('multimedia_objects')->field('tags')->in($tags)->sort('public_date', 'desc');
      $query = $qb->getQuery();
      $results = $query->execute();
    /*
      $query = $dm->createQuery('SELECT se
      FROM PumukitSchemaBundle:Series se
      WHERE se NOT IN(SELECT s
      FROM PumukitSchemaBundle:Series s
      JOIN s.multimedia_objects mm
      JOIN mm.tags t
      WHERE t IN (:tags)
      ORDER BY s.public_date DESC)')
      ->setParameter('tags', $tags);

      return $query->getResult();*/
    return $results;
  }

  /**
   * TODO DOC.
   */
  public function findByPicId($picId)
  {
      return $this->createQueryBuilder()
      ->field('pics._id')->equals(new \MongoId($picId))
      ->getQuery()
      ->getSingleResult();
  }

  /**
   * Find series by person id
   *
   * @param string $personId
   * @return ArrayCollection
   */
  public function findSeriesByPersonId($personId)
  {
      $repoMmobj = $this->getDocumentManager()->getRepository('PumukitSchemaBundle:MultimediaObject');

      $referencedSeries = $repoMmobj->findSeriesFieldByPersonId($personId);
     
      return $this->createQueryBuilder()
        ->field('id')->in($referencedSeries->toArray())
        ->getQuery()
        ->execute();
  }

  /**
   * Find series with given series type
   *
   * @param SeriesType $series_type
   * @return ArrayCollection
   */
  public function findBySeriesType(SeriesType $series_type)
  {
      return $this->createQueryBuilder()
        ->field('series_type')->references($series_type)
        ->getQuery()
        ->execute();
  }
}
